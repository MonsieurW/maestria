<?php
/**
 * Created by PhpStorm.
 * User: Camael24
 * Date: 16/01/14
 * Time: 17:22
 */
namespace Application\Bin\Command\Sample {

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
        );

        /**
         * The entry method.
         *
         * @access  public
         * @return  int
         */
        public function main()
        {

            $command = null;

            while (false !== $c = $this->getOption($v)) switch ($c) {

                case 'h':
                case '?':
                    return $this->usage();
                    break;
            }

            require 'hoa://Application/Config/Environnement.php';

            $this->readCapabilities();
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
                                $con->add($do, $idTheme, $ty, $lvl, $line[$i]);
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
}

__halt_compiler();
Sample command
