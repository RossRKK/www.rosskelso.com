+++
title = "CV"
date = "2025-02-13"
+++

<h2>Ross Kelso &nbsp; <a class="fa fa-github" href="https://github.com/RossRKK"></a>  <a class="fa fa-linkedin" href="https://www.linkedin.com/in/ross-kelso/"></a><a class="fa fa-download" href="/files/cv.pdf"></a></h2>

[ross@rosskelso.com](mailto:ross@rosskelso.com) Edinburgh, Scotland 

Software developer with 5 years' experience in full-stack development and a first class MSci in Computer Science from St Andrews.<br/>
Specialized in rapid development of data analysis and visualisation systems using `c#`, `python`, and `javascript`, with a background in machine learning, computer vision, and industrial software.<br/>

<h3>Technical Skills</h3>

Languages & Frameworks: `c#`, `python`, `javascript`, `typescript`, `.net`, `angular`, `react`, `sql`, `rust`<br/>
Technologies: `elasticsearch`, `git`, `azure`, `aws`, `docker`, `kubernetes`, `tensorflow`, `nodejs`, `windows`, `linux`, `ci/cd`<br/>
Concepts: Machine Learning, Data Engineering, Cloud Architecture, Computer Vision

<h2>Work Experience</h2>


<h3>Cintra HR & Payroll - Software Developer (since June 2025)</h3>
Creating HR & payroll management software. 

`c#` `typescript` `angular` `ci/cd` `aws` `docker` `terraform` `python` `mcp`

 * Delivered new cloud-based pensions UI with Angular and .NET ahead of schedule, focusing on UX improvements, validation logic, and data integrity when integrating with legacy database tables.
 * Identified and fixed critical validation middleware bug where premature type conversion caused required field and date validation to silently fail. Modified application-wide middleware to validate against loosely-typed request bodies, preventing entire classes of validation errors.
 * Designed and implemented load testing strategy using k6, then diagnosed and resolved database deadlocks caused by inefficient triggers. Refactored triggers by unrolling dynamic SQL and adding strategic indices, achieving 5x throughput improvement.
 * Work full-stack with emphasis on backend development in a cross-functional team of 4 developers, 1 PM, and 2 designers.
 * Developed a Model Context Protocol (MCP) server enabling AI coding assistants to search and retrieve relevant code across full-stack codebases and understand complex database relatonships and constraints, improving context accuracy for LLM-assisted development.

<h3>Intelligent Plant - Software Developer (2021-2025), Intern (University Holidays 2017-2021)</h3>
Creating data storage, analysis and visualisation solutions for the energy industry.

Lead developer for the [Industrial App Store API Python Client](https://appstore.intelligentplant.com/Home/AppProfile?appId=40d7a49722f84be4986318bb5cc98cf3) `python` `pandas` `django` `tensorflow`

 * Designed and implemented a Python SDK to simplify OAuth authentication and data access for the Industrial App Store API, automatically converting API responses to pandas DataFrames for data science workflows.
 * Set up and maintained JupyterHub instance in Kubernetes for internal and client data science work.
 * Created demonstration notebooks showing time series prediction with TensorFlow, used by industrial clients and university research partners.

Lead developer for [Sequence of Events Explorer](https://appstore.intelligentplant.com/Home/AppProfile?appId=f3175c7a68774ef1ae96de5e8c16900e) `c#` `javascript` `html` `css` `elasticsearch` `ci` `azure`
 * Built application from MVP to production as sole developer, becoming the company's 3rd largest product and sold to every client with alarm analysis capabilities.
 * Designed intuitive drag-and-drop query interface allowing users to build complex filters for industrial alarm event logs, dramatically reducing noise in sequence-of-events analysis.
 * Mentored junior developers through code reviews and maintained code quality standards as project technical lead.
 * Developed custom domain-specific query language with parser to translate user queries into Elasticsearch queries.
 * Architected frontend using clear MVC pattern with state-driven DOM updates, minimizing state synchronization issues and contributing to application stability.

Developer for [Alarm Analysis](https://appstore.intelligentplant.com/Home/AppProfile?appId=d2322b59ff334c97b49760e40000d28e) and Intelligent Plant Historian  `c#` `elasticsearch` `machine learning`
 * Created novel Hidden Markov Model approach to parse non-standard semi-structured alarm data from industrial sources with inconsistent formats (interleaved JSON, CSV, and fixed-width tables).
 * Built interactive web interface allowing domain experts to iteratively refine the model's field boundary detection and labelling.
 * Upgraded Elasticsearch from version 2 to 7, doubling query throughput at 1-second latency and achieving 10x improvement at 5-second latency through index optimization and breaking change migrations.
 * Worked directly with clients for on-site installations and support.
 * Developed and maintained a backend for performing complex data aggregations.


Developer for [Gestalt (PnID & Trend)](https://appstore.intelligentplant.com/Home/AppProfile?appId=2a59ca294ce2464cb14694b682294de5) `c#` `sql` `javascript` `azure`
 * Led architectural separation of monolithic API into distinct application and data components, enabling independent deployment cycles and reducing downtime.
 * Replaced file system storage with SQL database implementing hierarchical folder structure through relational model, enabling Azure App Service deployment with blue-green deployment strategy.

Experimental projects involving the application of AI and large language models to our software `python` `docker` `tensorflow` `ollama`
 * Deployed internal AI inference APIs for proposal writing and proof-of-concept industrial automation applications.
 * Developed locally-hosted coding assistants to maintain IP security while exploring LLM integration opportunities.


Lead developer for [Power BI Industrial Connector](https://appstore.intelligentplant.com/Home/AppProfile?appId=064fa04abe624c70a982e377a6c72850) `c#` `power query m` `react` `yarp` `azure`
* Replaced custom endpoint controllers with YARP proxy implementing licensing middleware.
* Maintained 100% backwards compatibility while fixing incorrectly named legacy functions.
* Re-architected connector removing reverse proxy data transformation dependency, enabling direct connection to on-premises installations and simplifying NTLM authentication.

Optimized the [Excel Data Query Add-in](https://appstore.intelligentplant.com/Home/AppProfile?appId=60e8ea6fc28a4abb902ce0b7b03b215b), reducing query time from minutes to seconds. `c#` `excel-dna`
 * Implemented async request processing to prevent UI blocking during data queries.
 * Designed intelligent request batching system bundling compatible queries reducing hundreds of individual requests to single batched calls.
 * Reduced typical query completion from 30+ seconds to near-instantaneous with responsive UI.
 

<h2>Education</h2>

<h3>University of St Andrews - Computer Science MSci First Class (2016-2021)</h3>

Deans' List, for academic excellence 2017/18, 2018/19, 2019/20

**Masters Thesis**

[Synthetic GPS Traces for Privacy Protection](/files/university-reports/synthetic-gps-traces-for-privacy-protection.pdf)
`python` `tensorflow` `pandas` `numpy`
 * Applied Markov Models and Convolutional Generative Adversarial Networks to synthesize realistic GPS movement data indistinguishable from real traces while preserving statistical properties like speed and path-following behavior.
 * Evaluated model accuracy and effectiveness in preserving statistical properties of real-world movement data.

**Senior Honours Project**

[Computer Vision in Cue Sports](/files/university-reports/computer-vision-in-cue-sports.pdf)
`opencv` `python`
* Designed computer vision system for unconstrained pool table analysis, handling arbitrary camera angles and partial occlusion without the need for calibration markers.
* Implemented perspective transformation and object detection achieving millimeter-scale ball position accuracy, 
* Developed snooker detection algorithm and generated 3D table models enabling arbitrary viewpoint rendering.

**Junior Honours Project**

Group software engineering project to create an encrypted wireless network of embedded devices
`c` `nodejs` `python` `git`
 * Led protocol design team coordinating inter-group standards for encrypted mesh network communication on Micro:bit devices.
 * Implemented RSA encryption from scratch in C, Python, and JavaScript to enable secure interoperability across devices, gateways, and web services.


<h3>Side Projects</h3>

**Game Design**
`rust` `bevy` `godot`

Competed in the [GMTK Game Jam 2025](https://rossrkk.itch.io/red-or-black) using `godot`.

Implemented a [Tetris clone](https://github.com/RossRKK/tetris) in `rust` using `SDL2` including a simple software synthesizer to play the classic music.

Implemented a [Flappy Bird clone](https://github.com/RossRKK/bevy-bird) in `rust` using `bevy` game engine.


<!-- **Other Modules**

* Algorithms and data structures `java`
* Artificial intelligence and machine learning `python` `java`
* Information Visualisation `python`
* Operating systems `c`
* Advanced programming projects `haskell` `python` -->

<!-- **Internet of Things**
`c` `python` `nodejs`
 * Created a network of micro-controllers that recorded temperature data around my flat to an Intelligent Plant Historian
 * Created a website showing whether communal items in my flat had run out, updated by an ESP-32 stuck to the fridge. -->


<!-- **Starfinder/D&D**
Game Master (since 2024)
* Coordinated and led a group of players through an immersive and engaging story, ensuring a cohesive and enjoyable experience for all participants.
* Designed challenging scenarios that required players to think critically and strategically to overcome.
* Improvised and responded to unexpected player choices or rule interpretations, using creative problem-solving and diplomacy to resolve conflicts and maintain a positive game environment. -->

<!-- **Pool Society**
Vice-president, Social Rep, Publicity and Fundraising Rep (2017-2021)
* Managed day-to-day operations, including equipment maintenance, weekly sessions and recruiting new members.
* Promoted the society through social media channels and organized fundraisers, including live streams of semesterly Finals Day events.
* Represented the university at several pool competitions, including 5 BUCS tournaments. -->


<!-- **Utilities Mod for Minecraft (2013)**
 * Taught myself how to develop a Minecraft mod using `java` and forge resulting in over 700 downloads -->


<!-- 
**The 'Walk' App**
`swift`
 * Created an app that interfaces with the Apple health app to track walking progress compared to a pre-set rate
 * This resulted in me walking 3,000km in 2024


**Games Room**
`nodejs` `python` `javascript` `html` `css`
* Developed a framework for creating online group games, such as Killer, using a variety of technologies.
* Collaborated with team members to design and implement the framework.

**Killer Web App**
Developer (2018) `nodejs` `html` `javascript` `css`
* Created a web app to simulate the cards used in the pool game "Killer" using client-side JavaScript.
* Developed a new version using Bootstrap, Node.js, WebSockets, and Heroku, allowing for multi-device spectating and control.

**Utilities Mod for Minecraft**
 * Developed a minecraft mod using Java and forge resulting in over 700 downloads
 * Revisited the mod and rebuilt the core features using Fabric

 -->

 
