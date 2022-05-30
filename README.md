# coderock

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
    <img src="images/logo.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Coderockr</h3>

  <p align="center">
    Esta é uma API contruida utilizando o laravel para a realização do teste para a Coderockr.
    <br />
    <a href="https://www.postman.com/iurruu/workspace/coderockr/collection/17815923-f79b9fb7-c3df-47ef-a124-9bce31a6f165?ctx=documentation"><strong>Documentação da api.</strong></a>
    <br />
  </p>
</div>

<!-- ABOUT THE PROJECT -->
## About The Project

Este é um projeto desenvolvido em laravel para a realização do teste para a Coderockr. 

Escolhi o framework laravel pela fácil implementação e criação de API, não escolhi o lumen, pois, pensando na escalabilidade do projeto seria facil implementar uma interface gráfica, utilizando VUE, React ou mesmo o próprio blade e Javascript vanilla. 


A API foi construída pensando em Services e Interfaces. 
Toda a documentação das classes de serviços está nas interfaces ficando apenas funções privadas documentadas na própria classe. 

<p align="right">(<a href="#top">back to top</a>)</p>




### Prerequisites

Comandos necessarios.

Instalar as dependências.
* composer
  ```sh
  composer install
  ```

Criar as tabelas e informaçoes adicionais ao banco de dados.
* artisan
  ```sh
  php artisan migrate --seed
  ```
