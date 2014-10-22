<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Resume extends Generic
    {
        public function indexAction($evaluate_id)
        {
            $answer = new \Application\Model\Answer();
            $eval   = new \Application\Model\Evaluation();
            $class  = new \Application\Model\Classe();
            $class  = $class->all();
            $usrcl  = new \Application\Model\UserClass();
            $answer = $answer->getEvaluation($evaluate_id);
            $tri    = array();
            $all    = array();
            $a      = array();

            foreach ($answer as $i => $response) {
                $user                = $response['refUser'];
                $classe              = $usrcl->getClass($user);
                $answer[$i]['class'] = $classe;

                foreach ($classe as $key => $value) {
                    $tri[$key][] = $answer[$i];
                    $a[$key][]   = $response['refUser'];
                }
            }

            foreach ($class as $key => $value) {
                $all[$value['idClass']] = $usrcl->getEleves($value['idClass']);
            }

            $this->data->evaluate    = $eval->get($evaluate_id);
            $this->data->evaluate_id = $evaluate_id;
            $this->data->a           = $a;
            $this->data->all         = $all;
            $this->data->tri         = $tri;
            $this->data->class       = $class;

            $this->greut->render();
        }

        public function showAction($evaluate_id, $resume_id)
        {
            $classroom_id   = $resume_id;
            $evaluation     = new \Application\Model\Evaluation();
            $evaluation     = $evaluation->get($evaluate_id);
            $questions      = new \Application\Model\Questions($evaluate_id);
            $questions      = $questions->get();
            $answer         = new \Application\Model\Answer();
            $answer         = $answer->getEvaluation($evaluate_id);
            $all            = array();
            $notes          = array();
            $real_note      = array();
            $notation       = 20;

            foreach ($questions as $question) {
                $all[$question['taxoPrincipal']][] = $question;
            }

            $convertNote = function ($note) {
                $note = intval($note);

                switch ($note) {
                    case 2:
                        return 1;
                        break;
                    case 1:
                        return 0.5;
                        break;
                    case 0:
                    case -1:
                    default:
                        return 0;
                }
            };

            $n = function ($note) {

                return round($note * 2) / 2;
            };

            foreach ($answer as $i => $eleve) {
                $re     = array();
                $note   = json_decode($eleve['note'], true);
                $moyen  = array();
                foreach ($all as $taxo => $qs)
                    foreach ($qs as $q) {
                        $re[$taxo][]                                = $convertNote($note[$q['idQuestion']]);
                        $notes[$eleve['refUser']][$q['idQuestion']] = array($q['note'], ceil($q['note'] * $convertNote($note[$q['idQuestion']]))); // TODO : Revoir algo !
                    }

                foreach ($re as $key => $v)
                    $moyen[$key] = array_sum($v) / count($v);

                foreach ($notes as $idUser => $note_question) {
                    $max = 0;
                    $cur = 0;

                    foreach ($note_question as $key => $value) {
                        if ($value[1] !== null and $value[0] !== null) {
                            $max += intval($value[0]);
                            $cur += intval($value[1]);
                        }
                    }
                    $real_note[$idUser] = $n(($notation * $cur) / $max);
                }

                $answer[$i]['result'] = $moyen;
            }

            $this->data->note_max  = $notation;
            $this->data->real      = $real_note;
            $this->data->answer    = $answer;
            $this->greut->render();
        }
    }
}
