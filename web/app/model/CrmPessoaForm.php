<?php

	namespace Model;

	use Lib\Util;

	class CrmPessoaForm extends \ActiveRecord\Model {

		static $table_name = 'crm_pessoaform';


        public static function setPessoaForm($data){

            $crm_pessoaform = new CrmPessoaForm;

            // Util::dbg($data);

            // not null
            $crm_pessoaform->pessoaid        = empty($data['pessoaid']) ? NULL : $data['pessoaid'];
            $crm_pessoaform->origemid        = empty($data['origemid']) ? NULL : $data['origemid'];
            $crm_pessoaform->dtinsert        = date("Y-m-d H:i:s");
            
            $crm_pessoaform->comoconheceuid  = empty($data['comoconheceuid']) ? NULL : $data['comoconheceuid'];
            $crm_pessoaform->statusid        = empty($data['statusid']) ? NULL : $data['statusid'];
            $crm_pessoaform->assuntoid       = empty($data['assuntoid']) ? NULL : $data['assuntoid'];
            $crm_pessoaform->imovelid        = empty($data['imovelid']) ? NULL : $data['imovelid'];
            $crm_pessoaform->lancamentoid    = empty($data['lancamentoid']) ? NULL : $data['lancamentoid'];
            $crm_pessoaform->mensagem        = empty($data['mensagem']) ? NULL : $data['mensagem'];
            $crm_pessoaform->mailfrom        = empty($data['mailfrom']) ? NULL : $data['mailfrom'];
            $crm_pessoaform->mailto          = empty($data['mailto']) ? NULL : $data['mailto'];
            $crm_pessoaform->mailcc          = empty($data['mailcc']) ? NULL : $data['mailcc'];
            $crm_pessoaform->mailcco         = empty($data['mailcco']) ? NULL : $data['mailcco'];
            $crm_pessoaform->mailreply       = empty($data['mailreply']) ? NULL : $data['mailreply'];
            $crm_pessoaform->mailsubject     = empty($data['mailsubject']) ? NULL : $data['mailsubject'];
            $crm_pessoaform->mailbody        = empty($data['mailbody']) ? NULL : $data['mailbody'];
            $crm_pessoaform->urlorigem       = empty($data['urlorigem']) ? NULL : $data['urlorigem'];
            $crm_pessoaform->iporigem        = empty($data['iporigem']) ? NULL : $data['iporigem'];
            $crm_pessoaform->navegadororigem = empty($data['navegadororigem']) ? NULL : $data['navegadororigem'];
            $crm_pessoaform->atendimentoid   = empty($data['lancamentoid']) ? NULL : $data['lancamentoid'];
            $crm_pessoaform->pessoaformpaiid = empty($data['pessoaformpaiid']) ? NULL : $data['pessoaformpaiid'];            

            // Util::dbg($crm_pessoaform);

            $crm_pessoaform->save();

            return $crm_pessoaform;

        }




        // funcao para setar os campos que foram atualizados
        private function setAttr($attr, $data){

            // testa se esta vazio no banco ou no novo objeto instanciado
            if (empty($this->$attr)){

                // se vazio, insere o valor do form
                $this->$attr = $data[$attr];

            }else{

                // se veio do banco e esta preenchido, verificar se vazio o form
                if (empty($data[$attr])) {

                    // se vazio, vao faz nada
                }else{

                    // se o form estiver preenchido, atualiza o atributo do obj para salvar no banco
                    $this->$attr = $data[$attr]; // not null
                }
            } 

            // retorna o atributo do objeto
            return $this->$attr;

        }
    }