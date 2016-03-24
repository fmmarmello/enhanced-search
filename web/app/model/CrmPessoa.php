<?php

	namespace Model;

	use Lib\Util;

	class CrmPessoa extends \ActiveRecord\Model {

		static $table_name = 'crm_pessoa';


        public static function setPessoa($data){

            // Util::dbg($data);

            // verifica se existe alguma pessoa cadastrada
            $crm_pessoa = CrmPessoa::findCrmPessoa($data['email']);
            // se nao existir, cadastra uma nova
            $crm_pessoa = ( $crm_pessoa ) ? $crm_pessoa : new CrmPessoa;

            // insert date e email sao permanentes, so insere quando o atributo esta vazio
            (empty($crm_pessoa->dtinsert))  ? $crm_pessoa->dtinsert = date("Y-m-d H:i:s")   : "";          // not null
            (empty($crm_pessoa->email))     ? $crm_pessoa->email = $data['email']           : "";          // not null

            // atualiza sempre
            $crm_pessoa->flagnewsletter     = ($data['flagnewsletter']) ? -1 : 0;     // not null
            $crm_pessoa->origemid           = $data['origemid'];                      // not null
            $crm_pessoa->userupdate         = date("Y-m-d H:i:s");

            // pode alterar
            $crm_pessoa->nome               = $crm_pessoa->setAttr('nome',$data);
            $crm_pessoa->comoconheceuid     = $crm_pessoa->setAttr('comoconheceuid',$data);
            $crm_pessoa->nometratamento     = $crm_pessoa->setAttr('nometratamento',$data);
            $crm_pessoa->emailalternativo   = $crm_pessoa->setAttr('emailalternativo',$data);
            $crm_pessoa->telresidencial     = $crm_pessoa->setAttr('telresidencial',$data);
            $crm_pessoa->telcelular         = $crm_pessoa->setAttr('telcelular',$data);
            $crm_pessoa->telcomercial       = $crm_pessoa->setAttr('telcomercial',$data);
            $crm_pessoa->estadocivil        = $crm_pessoa->setAttr('estadocivil',$data);
            $crm_pessoa->sexo               = $crm_pessoa->setAttr('sexo',$data);
            $crm_pessoa->dtnascimento       = $crm_pessoa->setAttr('dtnascimento',$data);
            $crm_pessoa->dtupdate           = $crm_pessoa->setAttr('dtupdate',$data);

            // Util::dbg($crm_pessoa);

            $crm_pessoa->save();

            return $crm_pessoa;

        }



        public static function findCrmPessoa($email){

            $sql = array(
                'select' => '
                    pessoaid, 
                    origemid, 
                    comoconheceuid, 
                    nome, 
                    nometratamento, 
                    email, 
                    emailalternativo, 
                    telresidencial, 
                    telcelular, 
                    telcomercial, 
                    estadocivil, 
                    sexo, 
                    dtnascimento, 
                    dtinsert, 
                    dtupdate, 
                    userupdate, 
                    flagnewsletter
                ',
                'from' => 'crm_pessoa',
                'conditions' => array('email = ?', $email),
                // 'order' => 'ordem ASC'
            );

            $result = self::find('first',$sql);

            return $result;
        }        



        // funcao para setar os campos que foram atualizados
        private function setAttr($attr, $data){

            // testa se esta vazio no banco ou no novo objeto instanciado
            if (empty($this->$attr)){

                // se vazio, insere o valor do form
                $this->$attr = empty($data[$attr]) ? NULL : $data[$attr];

            }else{

                // se veio do banco e esta preenchido, verificar se vazio o form
                if (empty($data[$attr])) {
                    // se vazio, preenche com NULL
                    $data[$attr] = NULL;
                }else{

                    // se o form estiver preenchido, atualiza o atributo do obj para salvar no banco
                    $this->$attr = $data[$attr]; // not null
                }
            } 

            // retorna o atributo do objeto
            return $this->$attr;

        }
    }