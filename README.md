Teste Técnico ABE3 - Gestão de Colaboradores

Sistema de gerenciamento de recursos humanos (CRUD de Pessoas e Cargos) com controle de histórico profissional e validação temporal.

Requisitos do Sistema

* PHP >= 7.4 (Testado com 8.1)
* CodeIgniter 3.1.13
* Banco de Dados: MySQL ou PostgreSQL
* Servidor Web: Apache ou Nginx

Instalação e Configuração

1. Clone o repositório para o diretório do seu servidor web.
2. Configure a URL base em `application/config/config.php`:

$config['base_url'] = 'http://localhost/seu-diretorio/';

3. Configure o banco de dados em `application/config/database.php`.

Banco de Dados

O projeto foi desenvolvido em ambiente local utilizando driver **MySQL**. No entanto, a aplicação utiliza estritamente o Query Builder do framework, garantindo compatibilidade com **PostgreSQL**.

Para avaliação, o script DDL compatível com PostgreSQL (incluindo sequences e constraints) está disponível em:
`database/script_postgresql.sql`

Funcionalidades Implementadas

Gestão de Histórico e Validações

O sistema implementa uma lógica de validação para impedir sobreposição de períodos (overlap) no histórico de cargos de um colaborador. A validação considera:

* Inserção de novos cargos.
* Edição de cargos existentes (ignorando o próprio registro na validação).
* Tratamento de cargos atuais (data_fim NULL).

Vínculo de Ocupantes

Implementado vínculo bidirecional:

1. Via Perfil do Colaborador: Atribuição de novo cargo.
2. Via Gestão de Cargo: Atribuição de novo ocupante.

Interface

Utilizado Bootstrap 5 com customizações de CSS para atender à identidade visual proposta (Dark/Yellow), mantendo responsividade para dispositivos móveis.