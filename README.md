# Teste - Data Frete
> Cadastro de CEPs e Cálculo de distâncias

O seguinte projeto é criado para satisfazer as condições do processo seletivo da Data Frete. 
Como pedido por e-mail, ele faz as funções de cadastro básicas: criar, ler, atualizar e excluir. Recebendo um CEP de Origem e um CEP de Destino ele faz o cálculo da distância entre eles. Usa como método de validação as APIs [CEP Aberto](https://cepaberto.com/) e [TomTomDeveloper](https://developer.tomtom.com/)

## Instalação

O projeto foi criado usando o XAMPP, portanto a instalação é referente ao mesmo

1. Clonar o projeto na pasta htdocs;
2. Iniciar o apache;
3. Através do localhost utilizar página `data_frete_teste/view/index.html`;

## Dependências

Para o projeto funcionar é preciso ter as sequintes dependências: 

1. XAMPP, Apache V2.4.46
2. Extensão do MongoDB em DLL (Versão 1.9.0) no seu PHP e a biblioteca MongoDB PHP Library ;
3. Composer instalado globalmente;

Para o processo de instalação foi usado o [tutorial do próprio mongoDB](https://docs.mongodb.com/php-library/current/tutorial/install-php-library/)

Todas as keys para as APIs e o MongoDB já estão dentro do projeto.
Para acessar a dashboard das APIs o login e senha estão dentro do seguinte arquivo: `info_keys.txt`

## Como Funciona?

Preenche-se os campos e clica em calcular distância:

![GIT 1](https://user-images.githubusercontent.com/30638819/105750088-04906c80-5f23-11eb-9462-d5cda6f33519.png)

Para fazer atualizações deve-se selecionar a linha da tabela a ser alterada ou excluída que automaticamente aparecerão as opções:

![GIT 2](https://user-images.githubusercontent.com/30638819/105751172-6a312880-5f24-11eb-8942-397f5468a728.png)


## Bibliotecas Usadas: 

1. [MDBootstrap](https://mdbootstrap.com/);
2. [JQuery](https://jquery.com/);
3. [DataTables](https://datatables.net/);
