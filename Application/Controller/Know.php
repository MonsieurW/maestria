<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Know extends Generic
    {
        public function indexAction()
        {

            $query       = $this->router->getQuery();
            $page        = isset($query['page']) ? $query['page'] : 1;
            $nbPost      = 20;
            $first_entry = ($page - 1) * $nbPost;

            $know               = new \Application\Model\Know();
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

            $this->data->know        = $know->all($first_entry, $nbPost);
            $this->data->pageCurrent = $page;
            $this->data->pageTotal   = ceil($know->count() / $nbPost);
            $this->data->domain      = $domain;
            $this->data->d           = $d;
            $this->data->t           = $t;
            $this->data->theme       = $theme;

            $this->greut->render();
        }

        public function createActionAsync()
        {
            $id     = (isset($_POST['pk']))     ? $_POST['pk']     : null;
            $value  = (isset($_POST['value']))  ? $_POST['value']  : null;
            $col    = (isset($_POST['name']))   ? $_POST['name']   : null;
            $mode   = (isset($_POST['mode']))   ? $_POST['mode']   : 'update';
            $theme  = (isset($_POST['theme']))  ? $_POST['theme']  : null;
            $domain = (isset($_POST['domain'])) ? $_POST['domain'] : null;
            $type   = (isset($_POST['type']))   ? $_POST['type']   : null;
            $level  = (isset($_POST['level']))  ? $_POST['level']  : null;
            $item   = (isset($_POST['item']))   ? $_POST['item']   : null;

            $connaissance = new \Application\Model\Know();

            switch ($mode) {
                case 'new':
                    $connaissance->add($domain, $theme, $type, $level, $item);
                    break;
                case 'delete':
                    $connaissance->destroy($id);
                    break;
                case 'update':
                default:
                    switch ($col) {
                        case 'level':
                            $connaissance->update($id, 'lvl', $value);
                            break;
                        case 'item':
                            $connaissance->update($id, 'item', $value);
                            break;
                        case 'type':
                            $connaissance->update($id, 'type', $value);
                            break;
                        case 'domain':
                            $connaissance->update($id, 'refDomain', $value);
                            break;
                        case 'theme':
                            $connaissance->update($id, 'refTheme', $value);
                            break;
                        default:
                            break;
                    }
                    break;
            }
        }
    }
}
