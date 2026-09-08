# FARMI
![Logo do projeto](https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Web/nova_logo_clara_sem_fundo%20(1).png)
>🌱 Tecnologia que protege e faz sua fazenda crescer

---

## Problema<br>
Muitos produtores rurais ainda utilizam controles manuais ou planilhas isoladas.
- Informações importantes da fazenda ficam dispersas, dificultando a análise e a tomada de decisão.
- Falta de monitoramento integrado de dados como produtividade, clima e saúde do rebanho.
- Risco de erros, desperdícios de recursos e perdas financeiras.

---

## Objetivo<br>
Desenvolver uma solução para **gestão e monitoramento de fazendas inteligentes**.
- Centralizar informações da propriedade em uma única plataforma.
- Permitir o **acompanhamento em tempo real** de dados agrícolas e ambientais.
- Ajudar na **tomada de decisões estratégicas**.
- Promover **maior produtividade, redução de custos e sustentabilidade no campo**.

---

## Público-Alvo<br>
- Produtores rurais  
- Gestores agrícolas  
- Empresas do agronegócio

---

## Funcionabilidades<br>
- **Coleta de dados**: Sensores instalados na fazenda coletam informações ambientais.
- **Envio dos dados**: As informações são enviadas para o sistema.
- **Armazenamento**: Os dados são armazenados no banco de dados.
- **Visualização**: O produtor pode acessar relatórios e indicadores pelo site.
- **Tomada de decisão**: Com base nos dados, o produtor pode planejar melhor suas atividades.

---

## Entregas por Sprint<br>

### Web
*Sprint 1* - 100%
- Login, cadastro e recuperação de senha - 100%
- Dashboard com dados em tempo real -100%
- Monitoramento de sensores - 100%
- Gestão de culturas e relatórios - 100%
- Sistema de alertas - 100%
- Painel administrativo - 100%

*Sprint 2* - 100%
- Acessibilidade do site - 100%
- Dashboard do administrador - 100%
- Telas de cadastro - 100%
- Melhora na identidade visual - 100%
- Conteúdo para redes sociais - 100%
- Vídeo propaganda - 100%

*Sprint 3* - 100%
- Criação e configuração do projeto utilizando CodeIgniter — 100%
- Desenvolvimento das Models, Controllers, Routes e Views — 100%
- Implementação do Filter e sistema de autenticação (Auth) — 100%
- Desenvolvimento do site do Workshop — 100%
- Desenvolvimento da identidade visual do Workshop — 100%
- Implementação da acessibilidade com modo de alto contraste — 100%
- Correção e aprimoramento do Dashboard — 100%


### Mobile
*Sprint 1* - 100%
- Login, cadastro e recuperação de senha - 100%
- Dashboard com dados em tempo real -100%
- Monitoramento de sensores - 100%
- Gestão de culturas e relatórios - 100%
- Sistema de alertas - 100%
- Painel administrativo - 100%

*Sprint 2* - 100%
- Identidade visual igual do web - 100%
- Dashboard do Usuário - 1000%


*Sprint 3* -
- Integração do Mobile com banco de dados

### IOT
*Sprint 1* - 100%
- Definição dos sensores (temperatura, umidade, luminosidade) - 100%
- Testes básicos de leitura de dados - 100%
- Estrutura para envio de dados (HTTP) - 100%
- Simulação de dados para integração futura - 100%

*Sprint 2* - 100%
- Vídeo da simulação de dados - 100%
- Criação do código básico - 100%

*Sprint 3* -
- Criação de protótipos 3D (cases) para os dispositivos IoT - 100%
---



## Tecnologias Utilizadas

### Linguagens
- HTML, CSS, JavaScript (Script)
- PHP
- Flutter (aplicativo móvel)
- MYSQL (banco de dados)
- BR Modelo / Comunidade Astah (modelagem)


### Internet das Coisas (IoT)

- Sensores de Umidade e Temperatura (DHT22)
- Sensores de Umidade do Solo (Higrômetro)
- Sensores de Luminosidade (LDR 5mm)

---

## Funcionamento da IoT no Farmi

### Sensor de Luminosidade (LDR)

- O sensor mede a intensidade de luz no ambiente da plantação.
- Os dados são enviados para o microcontrolador.
- As informações são registradas no banco de dados do sistema.
- O produtor pode visualizar os níveis de luminosidade pelo site.

### Sensor de Umidade do Solo

- O sensor é inserido no solo da plantação.
- Ele mede o nível de umidade presente na terra.
- Os dados são enviados para o sistema.
- O produtor pode acompanhar quando o solo precisa de irrigação.

### Sensor de Clima (DHT22)

- O sensor mede a temperatura e a umidade do ar.
- Os dados são enviados para o microcontrolador.
- As informações são armazenadas no banco de dados.
- O produtor pode acompanhar as condições climáticas em tempo real.

### Integração dos Sensores

- Os sensores coletam dados do ambiente da fazenda.
- Um microcontrolador (como ESP32 ou Arduino) recebe essas informações.
- Os dados são enviados para o sistema via internet.
- O sistema Farmi organiza e apresenta essas informações em gráficos e relatórios para o produtor.

---

## Equipe

| Nome | Função |
|------|------|
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/thaiene.jpeg" width="60"> Thaiene Tessaro | Programador Full Stack |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/isabella.jpeg" width="50"> Isabella Silva Fernandes Garcia | Programador Full Stack|
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/vitor.png" width="50">Vitor Delduca Fernandes | Analista de Sistemas e Design |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/maria.jpeg" width="60">Maria Clara Uliana Braga | Analista de Sistemas e Design |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/paula.jpeg" width="50">Paula Silva Zito | Programador Back-End |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/vinicius.png" width="50">Vinícius Bruno de Lima | Programador Back-End |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/paula.jpeg" width="50">Paula Silva Zito | Product Owner |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/thaiene.jpeg" width="60">Thaiene Tessaro | Scrum Master |

---

## Diagramas
### MER
- Modelo Entidade Relacionamento.<br>
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Banco_dados/MER_ATUALIZADO.jpg" width="700">

### DER
- Diagrama Entidade Relacionamento.<br>
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Banco_dados/DER_ATUALIZADO.jpg" width="700">

### Diagrama de Classes
- O Diagrama de Classes representa as classes de um sistema e como elas se relacionam.<br>
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Diagramas/diagrama_de_classes.png" width="700">

### Diagrama de Fluxos
- O Diagrama de Fluxo representa a sequência de etapas de um processo ou algoritmo.<br>
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Diagramas/diagrama_de_fluxos.png" width="700">

## Diagrama de IOT
- Diagrama IoT que mostra a conexão entre sensores, dispositivos e a nuvem para coleta e análise de dados em tempo real.
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Diagramas/Diagrama_IOT.png" width="700">

## Caixa IOT
- Serão armazenados os dispositivos IOT do nosso sistema.
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/IoT/Iot_caixa.png" width="700">

---
📧 [farmi.tcc2026@gmail.com]<br>
📸 [https://www.instagram.com/farmi.tech/]<br>
🎥 [https://tiktok.com/@_farmi.370]
---

# FARMI
![Project Logo](https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Web/nova_logo_clara_sem_fundo%20(1).png)

> 🌱 Technology that protects and helps your farm grow

---

## Problem

Many farmers still rely on manual controls or isolated spreadsheets.

- Important farm information is often scattered, making analysis and decision-making difficult.
- Lack of integrated monitoring of data such as productivity, climate conditions, and livestock health.
- Risk of errors, resource waste, and financial losses.

---

## Objective

Develop a solution for **smart farm management and monitoring**.

- Centralize farm information on a single platform.
- Enable **real-time monitoring** of agricultural and environmental data.
- Support **strategic decision-making**.
- Promote **higher productivity, cost reduction, and sustainability in agriculture**.

---

## Target Audience

- Farmers  
- Agricultural managers  
- Agribusiness companies

---

## Features

- **Data Collection**: Sensors installed on the farm collect environmental information.
- **Data Transmission**: The collected data is sent to the system.
- **Storage**: The information is stored in the database.
- **Visualization**: Farmers can access reports and indicators through the website.
- **Decision Making**: Based on the data, farmers can better plan their activities.

---

## Sprint Deliveries

### Web

*Sprint 1* - 100%

* Login, registration, and password recovery - 100%
* Real-time data dashboard - 100%
* Sensor monitoring - 100%
* Crop management and reports - 100%
* Alert system - 100%
* Administrative panel - 100%

*Sprint 2* - 100%

* Website accessibility - 100%
* Administrator dashboard - 100%
* Registration screens - 100%
* Visual identity improvements - 100%
* Social media content - 100%
* Promotional video - 100%

*Sprint 3* - 100%

* Project creation and configuration using CodeIgniter — 100%
* Development of Models, Controllers, Routes, and Views — 100%
* Implementation of Filters and the authentication system (Auth) — 100%
* Development of the Workshop website — 100%
* Development of the Workshop visual identity — 100%
* Implementation of accessibility features with high-contrast mode — 100%
* Dashboard fixes and improvements — 100%

### Mobile

Sprint 1* - 100%

- Login, registration, and password recovery - 100%
- Real-time data dashboard - 100%
- Sensor monitoring - 100%
- Crop management and reports - 100%
- Alert system - 100%
- Administrative panel - 100%

*Sprint 2* - 100%

*- Visual identity matching the web version - 100%
- User dashboard - 100%

*Sprint 3* -

- Mobile integration with the database

### IoT

*Sprint 1* - 100%

- Definition of sensors (temperature, humidity, and light intensity) - 100%
- Basic data reading tests - 100%
- Data transmission structure (HTTP) - 100%
- Data simulation for future integration - 100%

*Sprint 2* - 100%

- Data simulation video - 100%
- Development of the basic code - 100%

*Sprint 3* - 100%

- Creation of 3D prototypes (cases) for IoT devices - 100%

---

## Technologies Used

### Languages

- HTML, CSS, JavaScript
- PHP
- Flutter (mobile application)
- MySQL (database)
- BR Modelo / Astah Community (modeling)

### Internet of Things (IoT)

- Temperature and Humidity Sensors (DHT22)
- Soil Moisture Sensors (Hygrometer)
- Light Sensors (LDR 5mm)

---

## IoT Operation in Farmi

### Light Sensor (LDR)

- The sensor measures the light intensity in the plantation environment.
- The data is sent to the microcontroller.
- The information is stored in the system database.
- The farmer can view the light levels through the website.

### Soil Moisture Sensor

- The sensor is inserted into the plantation soil.
- It measures the level of moisture present in the soil.
- The data is sent to the system.
- The farmer can monitor when the soil needs irrigation.

### Climate Sensor (DHT22)

- The sensor measures air temperature and humidity.
- The data is sent to the microcontroller.
- The information is stored in the database.
- The farmer can monitor weather conditions in real time.

### Sensor Integration

- The sensors collect environmental data from the farm.
- A microcontroller (such as ESP32 or Arduino) receives this information.
- The data is sent to the system via the internet.
- The Farmi system organizes and displays this information in graphs and reports for the farmer.

---

## Team

| Name | Role |
|------|------|
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/thaiene.jpeg" width="60"> Thaiene Tessaro | Full Stack Developer |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/isabella.jpeg" width="40"> Isabella Silva Fernandes Garcia | Full Stack Developer |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/vitor.png" width="50"> Vitor Delduca Fernandes | Systems Analyst and Design |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/maria.jpeg" width="60"> Maria Clara Uliana Braga | Systems Analyst and Design |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/paula.jpeg" width="50"> Paula Silva Zito | Back-End Developer |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/vinicius.png" width="50"> Vinícius Bruno de Lima | Back-End Developer |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/paula.jpeg" width="50"> Paula Silva Zito | Product Owner |
|<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/equipe/thaiene.jpeg" width="60"> Thaiene Tessaro | Scrum Master |

---
## Diagrams

### MER
- Entity Relationship Model.<br>
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Banco_dados/MER_ATUALIZADO.jpg" width="700">

### DER
- Entity Relationship Diagram.<br>
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Banco_dados/DER_ATUALIZADO.jpg" width="700">

### Class Diagram
- The Class Diagram represents the classes of a system and how they relate to each other.<br>  
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Diagramas/diagrama_de_classes.png" width="700">

### Flowchart
- The Flowchart represents the sequence of steps in a process or algorithm.<br>  
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Diagramas/diagrama_de_fluxos.png" width="700">

## IOT Diagram
- IoT diagram showing the connection between sensors, devices, and the cloud for real-time data collection and analysis.
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/Diagramas/Diagrama_IOT.png" width="700">

## IoT Box
- The IoT devices used in our system will be stored here.
<img src="https://github.com/2IDS-A-TAMB-2026/FARMI/blob/main/IoT/Iot_caixa.png" width="700">

---

📧 [farmi.tcc2026@gmail.com]<br>
📸 [https://www.instagram.com/farmi.tech/]<br>
🎥 [https://tiktok.com/@_farmi.370]
---
