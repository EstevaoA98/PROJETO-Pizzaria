
Descrição do Projeto de Pizzaria Online
O sistema de pizzaria é uma aplicação web voltada para facilitar a personalização e o pedido de pizzas pelos clientes. A plataforma permite que os usuários escolham, de maneira intuitiva, os elementos de sua pizza, incluindo bordas, tipos de massa e até três sabores. Após configurar o pedido, o cliente pode finalizá-lo através de um botão de envio que simula o processamento e armazenamento dos dados.

Funcionalidades Principais
- Seleção Personalizada: Formulário interativo que possibilita ao cliente configurar todos os aspectos de sua pizza.
- Design Responsivo: A interface é adaptada para diferentes dispositivos (desktop e mobile), garantindo acessibilidade.
- Mensagens de Feedback: Exibição de mensagens como "Pedido feito com sucesso!" para confirmar a operação ao cliente.
- Modularidade: Arquitetura organizada com separação de responsabilidades, como formulários e templates reutilizáveis.
  ##
Tecnologias Utilizadas
- Frontend: PHP, CSS e Bootstrap para estrutura e estilização.
- Backend: PHP para manipulação e processamento de pedidos.
- Banco de Dados: MySQL Integração com um banco de dados para armazenar informações de pedidos.
  ##
Objetivo
- Criar uma experiência simplificada e eficiente para os clientes realizarem pedidos online, com foco em personalização e usabilidade, além de oferecer suporte à gestão de pedidos pela administração.

##
---

# Sistema de Gestão de Pedidos para Pizzaria  

Este projeto é um sistema de gestão de pedidos para pizzarias, desenvolvido em **PHP**, utilizando **MySQL** para o banco de dados e **Bootstrap** para a interface de usuário.  

## 📋 Pré-requisitos  
Certifique-se de que seu ambiente atenda aos seguintes requisitos antes de instalar o sistema:  
- **XAMPP** ou outro servidor local com suporte a PHP e MySQL.  
- **Git** para clonar o repositório (opcional).  
- Navegador da web para acessar o sistema.  

## 🛠️ Passos para rodar o projeto localmente  

### 1. Clone o repositório  
Se você já tem o Git instalado, use o comando:  
```bash
git clone https://github.com/seuusuario/nomedorepositorio.git
```  
Ou baixe o repositório como arquivo ZIP diretamente do GitHub e extraia os arquivos.  

### 2. Configure o ambiente local  
1. Instale o **XAMPP** (ou similar) e inicie os serviços de **Apache** e **MySQL**.  
2. Coloque os arquivos do projeto na pasta `htdocs` do XAMPP. O caminho normalmente será:  
   ```
   C:\xampp\htdocs\nomedoprojeto
   ```  

### 3. Configure o banco de dados  
1. Abra o **phpMyAdmin** no navegador. Normalmente o endereço é:  
   ```
   http://localhost/phpmyadmin
   ```  
2. Crie um novo banco de dados com o nome:  
   ```
   pizzaria_db
   ```  
3. Importe o arquivo `pizzaria_db.sql` (fornecido no repositório) para criar as tabelas e dados iniciais:  
   - Clique em **Importar** > **Escolher arquivo** > Selecione o arquivo `pizzaria_db.sql` > Clique em **Executar**.  

### 4. Configure os arquivos PHP  
No arquivo `config.php` (ou outro arquivo de configuração, dependendo do seu projeto), ajuste as configurações de conexão com o banco de dados:  
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Deixe vazio se estiver usando o XAMPP
define('DB_NAME', 'pizzaria_db');
```  

### 5. Acesse o sistema  
No navegador, acesse o endereço do projeto:  
```
http://localhost/nomedoprojeto
```  

## 🚀 Funcionalidades  
- Gerenciamento de pedidos com atualização de status (em produção, em entrega, concluído).  
- Cadastro e visualização de clientes e itens do pedido.  
- Interface responsiva utilizando **Bootstrap**.  

## 🛡️ Segurança  
- Proteção contra injeções de SQL com **prepared statements**.  
- Validação de dados do usuário.  

## 🧑‍💻 Contribuição  
Fique à vontade para contribuir! Faça um fork do repositório, realize as alterações e envie um pull request.  

## 📜 Licença  
Este projeto é de código aberto, licenciado sob a [MIT License](LICENSE).  

---
