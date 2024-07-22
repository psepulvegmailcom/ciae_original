# Experimento Opciones
Codigo del experimento que manipula el orden de las opciones
## Opciones de plataformas para programar los estimulos
1. questionpro (https://www.questionpro.com/help/)
* Pros: Tiene opciones para agregar imágenes em MCQ. Guarda el tiempo.
* Contras: Servidor externo no permite la privacidad integra de los datos. Código no reutilizable y se programa interfaz manual.
2. jspsych (https://www.jspsych.org/) y mejor opción hasta el momento
* Pros: Tiene opciones para agregar imágenes em MCQ. Guarda el tiempo. Servidor a elegir que permite la privacidad intgra de los datos. Codigo reutilizable
* Contras: Posibles problemas con la configuración del Host (Ver dos siguientes herramientas).
3. psiturk (http://www.psiturk.org/ee/) (Herramienta para configurar host de jspsych)
4. Gorilla (Herramienta para configurar host de jspsych)

**Se decide usar jspsych y alojarlo en primera instancia en Tonohost, un servidor genérico y gratis con PHP instalado.**
## Configurar el Host en jspsych
* ~~Estudiar información de configuración en https://www.jspsych.org/overview/data/ (Uso de MySQL)~~ 

**Siguiendo las instrucciones en la sección "Storing data permanently as a file" en el link del título, se crea el archivo PHP para una función en JS para escribir los resultados del experimento en formato CSV.**
## Programar el experimento local en jspsych
* ~~Implementar questionario demográfico en el principio.~~
* ~~Implementar modo pantalla completa y salida del modo pantalla completa en el final.~~
* ~~Implementar MCQ simple vertical y guardar tiempos de respuestas.~~
* ~~Guardar datos demograficos.~~
* ~~Estudiar plugin "serial-reaction-time-mouse". Editar este plugin para obtener una vista horizontal de imagenes, con cada imagen asociada a un boton, y con opción de guardar el tiempo de este click.~~
* ~~Guardar data con el nombre insertado en la encuesta demografica. Además, revisar el plugin que cuenta hacia atrás con el reinicio de la página, para averiguar como el programa entiende que es el mismo usuario.~~ (*Se actualiza esta tarea porque el plugin no cuenta hacia atrás si se reinicia el experimento, sólo cuenta hacia atrás con otras teclas. Además, la data será guardada con protocolo PHP, por lo que la data se guardará solo con el número del participante.*)
* ~~Agregar curso, colegio, sexo y mail/numero de telefono en la encuesta demográfica.~~
* ~~Primero debe aparecer un mensaje de bienvenida (Por enviar ...).~~
* ~~El consentimiento debe adjuntarse junto con la encuesta demografica, en un hiperlink que abre el documento completo (he leido y acepto, he leido y no acepto.)~~
* ~~Agregar instrucciones generales.~~
* ~~Agregar instrucciones para MCQ simple.~~
* ~~Agregar instrucciones para MCQ con imagenes.~~
* ~~Salida de pantalla completa con mensaje de salida y el link a zoom.~~
* ~~Agregar escala likert de seguridad en la MCQ.~~
* ~~Agregar cuestionario de métodos de estudio en medio del MCQ y el "Juego".~~
* ~~Estudiar css-classes-parameter.html para dar estilo a los mensajes de bienvenida e instrucciones.~~
* ~~Convertir última pantalla con el link a una pantalla con hiperlink y versión HTML simple (sin el escape con cualquier tecla por defecto del plugin.)~~
* ~~Solución temporal al guardado de datos y asignación de condiciones: A cada participante se le asigna un código (numero aleatorio de 4 cifras) que debe digitar en la primera pantalla, a fin de acceder al experimento y poner un nombre a la data.~~
* ~~Cambiar a 3 opciones la parte de MCQ, Modificar escala likert con la información del correo, agregar cuestionario de estrategias de estudio.~~
* ~~Completar instrucciones del cuestionario sobre metas acádemicas.~~
* ~~Usando codigo php y js, consultar al servidor cuantos archivos hay en una carpeta, usando como base el segundo codigo php del archivo **write_data_part.php**, con ello, guardar la data actual con este número y enviar desde el js al php el número, que será la asignación de la condición (número mod 6) del experimento. Por último, ambas consultas se deben hacer de forma asincrónica, para evitar que a dos participantes les toque la misma condición.~~
* ~~Crear juego de los 3 cuadrados con título en la parte superior, usando el plugin simple de **serial-reaction-time-mouse.**.~~
* ~~Ingresar instrucciones del juego (Camila).~~
* ~~Ingresar MCQ en la forma 1, juntoox con la escala likert.~~
* ~~Crear un algoritmo para cambiar las formas. La función debe considerar la información de los distactores.~~ (**Las opciones en distintas condiciones fueron ingresadas manualmente.**)
* ~~Modificar plugin **survey-multi-choice** con el fin de obtener letras ( a), b), ..) en vez de circulos blancos.~~(**Se puso la letra al lado del circulo blanco**)
* ~~Escribir archivo js con información de la parte de transferencia del juego (Camila)~~.
* ~~Alinear a la izquierda todos los textos, sobretodo el dialogo. Además, agrandar los margenes, agrandar el tamaño de letra de las escalas likert, y cambiar a una fuente en donde todos los caracteres tengan el mismo tamaño (Camila).~~(**Cambiar el tamaño de los caracteres queda como trabajo futuro para la implementación del eye-tracker.**)
* ~~Randomizar el orden de los itemes en MCQ.~~
* ~~Agregar parte MCQ de la parte del juego de trasferencia.~~
* ~~Convertir última pantalla a HTML simple.~~
* ~~Subir imágenes del juego en jpg (Camila).~~
* ~~Identificar usuario según su red.~~
* ~~Sacar la ultima hoja del asentimiento.~~
* ~~Cambiar margenes del MCQ.~~
* ~~Crear variables para los juegos verticales y horizontales.~~
* ~~Crear variables para el juego de las sillas.~~
* ~~Crear la pantalla de los pares de palabras de interferencia.~~
* ~~Cambiar el tamaño de letras general (Camila).~~
* ~~Intrucciones generales y de MCQ con el estilo adecuado.(Camila).~~
* ~~ingresar imágenes a todos los juegos.~~

## Cerrado. 