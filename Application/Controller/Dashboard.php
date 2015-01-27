<?php

namespace Application\Controller {

    class Dashboard extends Generic
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

//            echo '<pre>';   

			$answer = new \Application\Model\Answer();
			$q      = new \Application\Model\Questions();
            $ddddd  = new \Application\Model\Domain();
            $know   = new \Application\Model\Know();
			$max    = 20;
			$x      = []; 
            $data_d = [];
            $data_e = [];

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

            $store = function ($value) use (&$data_d) {
                if(!in_array($value, $data_d)){
                    $data_d[] = intval($value);
                }
            };

            $x         = [];

			foreach ($user as $key => $value) {
				$id          = $value['idProfil'];
				$answers     = $answer->getStudentEvaluation($id);
				$selfNote    = [];
				$total       = [];
                $data_e[$id] = $value['user'];

				foreach ($answers as $key => $reponse) {
//                    echo $id.': '.$reponse['note']."\n";
					$ans       = json_decode($reponse['note'], true);
					$eval      = $reponse['refEvaluation'];
                    
					foreach ($ans as $i => $v) {
						$currentQuestion        = $q->getID($i)[0];
                        $i1                     = $know->getDomain($currentQuestion['refItem1']);
                        $i2                     = $know->getDomain($currentQuestion['refItem2']);
                        $x[$id][$i1][$eval][]   = $convertNote($v);
                        
                        if($i1 !== $i2) {
                            $x[$id][$i2][$eval][]   = $convertNote($v);
                            
                        }
                        
                        $store($i1);
                        $store($i2);
					}

				}
			}
			
//            foreach ($x as $uid => $value) {
//                echo $uid.': '.implode(',',$value[1][1])."\n";
//            }
//            exit;

			$this->data->x      = $x;
            $this->data->data_d = $data_d;
            $this->data->data_e = $data_e;

            $domain = [];

            foreach ($ddddd->all() as $key => $value) {
                $domain[$value['idDomain']] = $value['domainValue'];
            }

            $this->data->domain = $domain;
            
            $this->greut->render();
        }
    }
}