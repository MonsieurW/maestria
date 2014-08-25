<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Know extends Generic
    {
    	public function check()
        {
            if($this->connected === false){
                $this->redirector->redirect('mainlogin');
            }
            // TODO : Make ACL
        }

        public function indexAction()
        {
            $classe             = new \Application\Model\Know();
            $domain             = new \Application\Model\Domain();
            $domain             = $domain->all();
            $d                  = array();
            $theme              = new \Application\Model\Theme();
            $theme              = $theme->all();
            $t                  = array();

            foreach ($domain as $value) {
                $d[$value['idDomain']] = $value['domainValue'];
            }

            foreach ($theme as $value) {
                $t[$value['idTheme']] = $value['themeValue'];
            }

            $this->data->know   = $classe->all();
            $this->data->domain = $domain;
            $this->data->d      = $d;
            $this->data->t      = $t;
            $this->data->theme  = $theme;



            $this->greut->render();
        }

        public function CreateActionAsync()
        {
            $theme  = (isset($_POST['theme']))  ? $_POST['theme']   : null;
            $domain = (isset($_POST['domain'])) ? $_POST['domain']  : null;
            $type   = (isset($_POST['type']))   ? $_POST['type']    : null;
            $level  = (isset($_POST['level']))  ? $_POST['level']   : null;
            $item   = (isset($_POST['item']))   ? $_POST['item']    : null;


            $connaissance = new \Application\Model\Know();
            $connaissance->add($domain, $theme, $type, $level, $item);
        }
    }
}
