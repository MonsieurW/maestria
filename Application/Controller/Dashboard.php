<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Dashboard extends Kit
    {

        public function indexAction($classroom_id) {
            
            /**
			* Read User
            */

        	$user  = new \Application\Model\UserClass();
        	$user  = $user->getEleves($classroom_id);
        	$users = [];

        	foreach ($user as $key => $value) {
        		$users[$value['idProfil']] = $value['user'];
        	}

        	$this->data->users = $users;

        	/**
        	* Read Domain
        	*/

        	$domain  = new \Application\Model\Domain();
        	$domain  = $domain->all();
        	$domains = [];

        	foreach ($domain as $key => $value) {
        		$domains[] = $value['domainValue'];
        	}

        	$this->data->domains = $domains;

        	/**
			* Read evaluation
        	*/

			$answer = new \Application\Model\Answer();
			$q      = new \Application\Model\Questions();
			$max    = 20;
			$data   = []; 

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

			foreach ($user as $key => $value) {
				$id        = $value['idProfil'];
				$answers   = $answer->getStudentEvaluation($id);
				$selfNote  = [];
				$total     = [];

				foreach ($answers as $key => $reponse) {
					$questions = json_decode($reponse['note'], true);
					$eval      = $reponse['refEvaluation'];
					foreach ($questions as $id => $v) {
						$currentQuestion 		= $q->getID($id)[0];
						$total[$eval][]         = intval($currentQuestion['note']);
						$selfNote[$eval][]      = $convertNote($v); // * intval($currentQuestion['note']); Note non coeffiencté
					}

				}

				$note = [];
				foreach ($selfNote as $eval => $n) {
					$sN 	= array_sum($n);	
					$tN 	= array_sum($total[$eval]);
					$note[] = $sN * $max / $tN;
				}

				$data[$id]['eval'] = json_encode($note);
				$data[$id]['moy']  = array_sum($note) / count($note);
			}
			
			$this->data->data = $data;
            
            $this->greut->render();
        }
    }
}