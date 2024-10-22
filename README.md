# API dash-financeiro

Para o bom funcionamento do projeto localmente em uma máquina Windows você precisará de:

<li>Instalar o Xammp com a versão php 8.1.12</li>
<li>Instalar o Workbench</li>
<li>Criar um schema no MySql</li>
<li>Instalar o Composer na versão 2.7.7</li>
<li>Instalar o GIT</li>

<p> Em uma pasta, clone o projeto</p>
<code> git clone "<NOME_PROJETO>" </code>
<p>Abra o terminal na pasta do projeto e rode</p>
<code> composer install </code>
<p>crie uma copia do arquivo .env.example com o nome .env e mude as configurações do banco de dados</p>
<p>após essa etapa, você rodarás as migration e os seeds para criar suas tabelas e popular com alguns dados padrões</p>
<code> php artisan migrate </code>
<code> php artisan db:seed --class=UsuariosSeeder </code>
<code> php artisan db:seed --class=EmpressasSeeder </code>
<code> php artisan db:seed --class=AtivosSeeder </code>
<code> php artisan db:seed --class=AplicacoesSeeder </code>
<code> php artisan db:seed --class=MovimentacoesSeeder </code>