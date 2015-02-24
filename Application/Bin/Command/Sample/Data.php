<?php
/**
 * Created by PhpStorm.
 * User: Camael24
 * Date: 16/01/14
 * Time: 17:22
 */
namespace Application\Bin\Command\Sample;

    use Hoa\Console\Chrome\Text;
    use Hoa\File\Finder;

    class Data extends \Hoa\Console\Dispatcher\Kit
    {

        /**
         * Options description.
         *
         * @var \Hoa\Core\Bin\Welcome array
         */
        protected $options = array(
            array('help', \Hoa\Console\GetOption::NO_ARGUMENT, 'h'),
            array('help', \Hoa\Console\GetOption::NO_ARGUMENT, '?'),
            array('test', \Hoa\Console\GetOption::NO_ARGUMENT, 't'),
        );

        protected $maxEleve = 5;
        protected $maxQuestion = 5;
        protected $defaultPassword = 'sample';

        /**
         * The entry method.
         *
         * @access  public
         * @return  int
         */
        public function main()
        {

            $command = null;
            $test    = false;

            while (false !== $c = $this->getOption($v)) switch ($c) {
                case 't':
                    $test = true;
                    break;
                case 'h':
                case '?':
                    return $this->usage();
                    break;
            }

            require 'hoa://Application/Config/Environnement.php';

            if($test === true)
                \Hoa\Database\Dal::getInstance('test');

            $this->readCapabilities();
            $this->makeSomeUser();
            $this->makeEvaluation();
            $this->makeAnswer();
        }

        public function makeAnswer()
        {
            $evaluations = new \Application\Model\Evaluation();
            $answer      = new \Application\Model\Answer();
            $evaluations = $evaluations->all();

            foreach ($evaluations as $evaluation) {
                $questions  = new \Application\Model\Questions($evaluation['idEvaluation']);
                $questions  = $questions->all();
                $minus      = $this->_minus($questions);
                $prime      = $this->_prime($questions);
                $unknow     = $this->_unknow($questions);
                $medium     = $this->_medium($questions);
                $eleves     = new \Application\Model\UserClass();
                $eleves     = $eleves->getEleves(1);

                // TODO : Resume & Note are !== need check !

                foreach ($eleves as $key => $eleve) {
                    if ($key === 0) {
                        $answer->value($eleve['idProfil'], $evaluation['idEvaluation'], $minus);
                        echo $eleve['user'].' is minus'."\n";
                    } elseif ($key === 1) {
                        $answer->value($eleve['idProfil'], $evaluation['idEvaluation'], $prime);
                        echo $eleve['user'].' is prime'."\n";
                    } elseif ($key === 2) {
                        $answer->value($eleve['idProfil'], $evaluation['idEvaluation'], $unknow);
                        echo $eleve['user'].' is unkown'."\n";
                    } else {
                        $answer->value($eleve['idProfil'], $evaluation['idEvaluation'], $medium);
                        echo $eleve['user'].' has medium answer'."\n";
                    }
                }

            }

        }

        protected function _question($questions, $value)
        {
            $out = array();
            foreach ($questions as $question)
                $out[$question['idQuestion']] = $value;

            return $out;
        }

        protected function _minus($questions)
        {
            return $this->_question($questions, 0);
        }

        protected function _prime($questions)
        {
            return $this->_question($questions, 2);
        }

        protected function _medium($questions)
        {
            return $this->_question($questions, 1);
        }

        protected function _unknow($questions)
        {
            return $this->_question($questions, -1);
        }

        public function makeEvaluation()
        {
            $user           = new \Application\Model\User();
            $capabilities   = new \Application\Model\Know();
            $capabilities   = $capabilities->getAll();
            $m_cap          = count($capabilities) - 1;
            $prof           = $user->getProfessor();
            $faker          = \Faker\Factory::create();

            foreach ($prof as $p)
                for ($i =0; $i <= 5; $i++) {
                    $e          = new \Application\Model\Evaluation($p['idProfil']);
                    $label      = $faker->sentence;
                    $id         = $e->create($label, $faker->paragraph);
                    $question   = new \Application\Model\Questions($id);

                    echo 'Evaluation for '.$p['user'].' #'.$id.' : '.$label."\n";

                    for ($j= 0; $j <= $this->maxQuestion; $j++) {
                        $note   = rand(1, 10);
                        $taxo   = rand(1, 4);
                        $item1  = rand(0, $m_cap);
                        $item2  = rand(0, $m_cap);
                        $title  = $faker->slug;

                        $question->create($title, $note, $taxo, $capabilities[$item1]['idConnaissance'], $capabilities[$item2]['idConnaissance']);
                        echo "\t".$title.' : '.$note."\n";

                    }
                }

        }

        public function makeSomeUser()
        {
/*

1 INSERT INTO class VAlUES (null, '1°L');
2 INSERT INTO class VAlUES (null, '1°S');
3 INSERT INTO class VAlUES (null, '1°ES');
4 INSERT INTO class VAlUES (null, 'T°L');
5 INSERT INTO class VAlUES (null, 'T°S');
6 INSERT INTO class VAlUES (null, 'T°ES');

*/

            $user       = new \Application\Model\User();
            $userclass  = new \Application\Model\UserClass();
            $password   = 'sample';
            $faker      = \Faker\Factory::create();

            for ($i = 1; $i <= 6; $i++) {
                for ($j = 0; $j <= $this->maxEleve; $j++) {

                    $name       = $faker->name;
                    $username   = $faker->username;
                    $id         = $user->add($username, $password, $name);

                    $userclass->associate($id, $i);
                    echo 'User : '.$name. ' > '.$username."\n";
                }
            }
        }

        public function readCapabilities()
        {

            $connaissance   = 'hoa://Application/Config/pedagogiques.csv';
            $connaissance   = new \Hoa\File\Read($connaissance);
            $theme          = new \Application\Model\Theme();
            $con            = new \Application\Model\Know();
            $domaine        = new \Application\Model\Domain();
            $ty             = 0;

/*
    INSERT INTO domain VAlUES (1, 'electricte');
    INSERT INTO domain VAlUES (2, 'physique');
    INSERT INTO domain VAlUES (3, 'optique');
    INSERT INTO domain VAlUES (4, 'chimie');
    INSERT INTO domain VAlUES (5, 'thermo-dynamique');
    INSERT INTO domain VAlUES (6, 'mathematique');
    INSERT INTO domain VAlUES (7, 'general');
*/

            while ($connaissance->eof() !== true) {
                $line = str_getcsv ($connaissance->readLine());

                if ($line[0] !== '' and $line[0] !== '1') {
                    $id = $line[0];
                    $th = $line[1];

                    switch ($id[0]) {
                        case '1':
                            $do = 1;
                            break;
                        case '3':
                            $do = 2;
                            break;
                        case '4':
                            $do = 3;
                            break;
                        case '5':
                            $do = 4;
                            break;
                        case '6':
                            $do = 5;
                            break;
                        case '7':
                            $do = 6;
                            break;
                        case '9':
                            $do = 7;
                        default:
                            $do = 7;
                            $ty = 1;
                            break;
                    }

                    if (trim($th) !== '') {
                        $idTheme = $theme->add($th);
                        if ($idTheme === null) {
                            $idTheme  = $theme->getID($th);
                        }
                        $lvl = 1;
                        for ($i = 2; $i < count($line); $i++) {

                            if ($line[$i] !== '') {
                                echo 'Add '.$id.' > '.$th.':'.$line[$i]."\n";
                                $con->add($do, $idTheme, $line[$i]);
                            }

                            $lvl++;
                        }
                    }

                }
            }

            return;
        }

        /**
         * The command usage.
         *
         * @access  public
         * @return  int
         */
        public function usage()
        {
            echo \Hoa\Console\Chrome\Text::colorize('Usage:', 'fg(yellow)') . "\n";
            echo '   Welcome ' . "\n\n";

            echo $this->stylize('Options:', 'h1'), "\n";
            echo $this->makeUsageOptionsList(array(
                'help' => 'This help.'
            ));

            return;
        }
    }
__halt_compiler();
Sample command
