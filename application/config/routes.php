<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//
// ========================== CONFIGURAÇÕES BÁSICAS ==========================
//

// Rota padrão do sistema (Tela inicial ao abrir o site)
$route['default_controller'] = 'Funcionarios_controller/perfil_login';

// Rota para página 404 personalizada
$route['404_override'] = '';

// Configuração para traduzir hífens na URL para underscores nos métodos
$route['translate_uri_dashes'] = FALSE;

//
// ========================== FUNCIONÁRIOS ==========================
//

// Listar funcionários (GET)
$route['funcionarios']['get'] = 'Funcionarios_controller/listar_funcionarios';

// Adicionar funcionário (POST)
$route['adicionar-funcionario']['post'] = 'Funcionarios_controller/add_funcionario';

// Formulário para editar funcionário (GET)
$route['editar-funcionario/(:num)']['get'] = 'Funcionarios_controller/formulario_editar/$1';

// Enviar dados de edição (POST)
$route['editar-funcionario']['post'] = 'Funcionarios_controller/editar_funcionario';

// Formulário para deletar funcionário (GET)
$route['deletar-funcionario'] = 'Funcionarios_controller/deletar_funcionario';

// Exibir tela de perfil do funcionário (GET)
$route['perfil']['get'] = 'Funcionarios_controller/perfil_funcionario';

// Rota para teste (GET)
$route['listar']['get'] = 'Funcionarios_controller/listar_teste';

//
// ========================== AUTENTICAÇÃO ==========================
//

// Fazer login (POST)
$route['login']['post'] = 'Auth_controller/logar';

// Fazer logout (GET)
$route['deslogar']['get'] = 'Auth_controller/deslogar';

//
// ========================== PERFIL ==========================
//

// Visualizar o próprio perfil (GET)
$route['meu-perfil']['get'] = 'Funcionarios_controller/exibir_perfil';

// Atualizar o próprio perfil (POST)
$route['meu-perfil']['post'] = 'Funcionarios_controller/atualizar_perfil';

// Apagar o próprio perfil (GET)
$route['meu-perfil/apagar']['get'] = 'Funcionarios_controller/apagar_meu_perfil';

// Carrinho (GET)
$route['carrinho']['get'] = 'outros_controller/carrinho';

//
// ========================== LOJA EXTERNA (ROUPAS) ==========================
//

// Listar roupas externas (GET)
$route['roupa_list']['get'] = 'outros_controller/roupa_list';

// Listar roupas (GET)
$route['roupas']['get'] = 'roupa_controller/listar_roupas';

// Visualizar roupas (rota sem método especificado - padrão GET)
$route['roupas'] = 'roupa_controller/visualizar_roupas';

// Adicionar roupa ao carrinho (ID da roupa)
$route['roupas/adicionar/(:num)'] = 'Roupa_controller/adicionar/$1';

// Exibir carrinho (ATENÇÃO: essa rota está duplicada e gera conflito!)
$route['carrinho'] = 'roupa_controller/ver';

// Remover item do carrinho (ID do item)
$route['remover/(:num)'] = 'roupa_controller/remover/$1';

// Finalizar compra
$route['finalizar'] = 'roupa_controller/finalizar_compra';

//
// ========================== ROUPAS (ÁREA ADMIN) ==========================
//

// Listar roupas na área administrativa
$route['roupa_list'] = 'Roupas_admin_controller/listar_roupas';

// Formulário para editar roupa (GET) com ID
$route['roupas/editar/(:num)']['get'] = 'Roupas_admin_controller/formulario_editar/$1';

// Enviar dados da edição (POST) com ID
$route['roupas/editar/(:num)']['post'] = 'Roupas_admin_controller/editar/$1';

// Listar roupas na área administrativa (página principal)
$route['roupas-admin'] = 'Roupas_admin_controller/listar_roupas';

// Adicionar roupa na área administrativa
$route['roupas-admin/adicionar'] = 'Roupas_admin_controller/adicionar';

// Excluir roupa na área administrativa com ID
$route['roupas-admin/excluir/(:num)'] = 'Roupas_admin_controller/excluir/$1';

//
// ========================== PAGAMENTO ==========================
//

// Finalizar compra (rota específica de pagamento)
$route['finalizar-compra'] = 'Pagamento_controller/iniciar';

//
// ========================== ACESSO AO LOGIN ==========================
//

// Página de login
$route['logar'] = 'auth_controller/index';

$route['finalizar-compra'] = 'pagamento_controller/iniciar';

$route['historico-compras'] = 'pagamento_controller/historico'; 
