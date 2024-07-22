var instrucciones_Metas = '<h1 style="margin-top: 5%">Cuestionario para la Evaluación de Metas Académicas</h1>';
instrucciones_Metas = instrucciones_Metas.concat('<p style="font-size: 120%; margin-left: 3%; margin-top: 5%">Este es un cuestionario que permite conocer cuáles son los principales motivos por los que los estudiantes se esfuerzan en su trabajo académico.');
instrucciones_Metas = instrucciones_Metas.concat(" A continuación, se te presentarán una serie de afirmaciones acerca de los motivos que puedes tener para estudiar.");
instrucciones_Metas = instrucciones_Metas.concat("<br>Te pedimos que contestes a dichas afirmaciones reflexionando sobre el contenido de cada una de ellas, que, aunque te parezcan semejantes, en realidad, no lo son.");
instrucciones_Metas = instrucciones_Metas.concat("<br>NO HAY RESPUESTAS CORRECTAS o INCORRECTAS, sólo queremos que respondas con la mayor precisión y sinceridad posible a las preguntas que se plantean.");


var metas_preguntas = ['<p style="font-size:120%;">Yo estudio porque para mí es interesante resolver problemas.</p>',
'<p style="font-size:120%;">Yo estudio porque me gusta ver cómo voy avanzando.</p>',
'<p style="font-size:120%;">Yo estudio porque me gusta conocer muchas cosas.</p>',
'<p style="font-size:120%;">Yo estudio porque me gusta el desafío que plantean los problemas o tareas difíciles.</p>',
'<p style="font-size:120%;">Yo estudio porque me siento bien cuando supero obstáculos y/o fracasos. </p>',
'<p style="font-size:120%;">Yo estudio porque soy muy curioso(a).</p>',
'<p style="font-size:120%;">Yo estudio porque me gusta usar la cabeza (mis conocimientos).</p>',
'<p style="font-size:120%;">Yo estudio porque me siento muy bien cuando resuelvo problemas o tareas difíciles.</p>',
'<p style="font-size:120%;">Yo estudio porque quiero ser elogiado(a) por mis padres y profesores.</p>',
'<p style="font-size:120%;">Yo estudio porque quiero ser valorado(a) por mis amigo(a)s.</p>',
'<p style="font-size:120%;">Yo estudio porque no quiero que mis compañero(a)s se burlen de mí. </p>',
'<p style="font-size:120%;">Yo estudio porque no quiero que mis profesores me critiquen.</p>',
'<p style="font-size:120%;">Yo estudio porque quiero que la gente vea lo inteligente que soy.</p>', 
'<p style="font-size:120%;">Yo estudio porque deseo obtener mejores notas que mis compañero(a)s.</p>',
'<p style="font-size:120%;">Yo estudio porque quiero obtener buenas notas. </p>',
'<p style="font-size:120%;">Yo estudio porque quiero sentirme orgulloso(a) de obtener buenas notas.</p>',
'<p style="font-size:120%;">Yo estudio porque no quiero fracasar en los pruebas semestrales. </p>',
'<p style="font-size:120%;">Yo estudio porque quiero terminar bien mis estudios.</p>',
'<p style="font-size:120%;">Yo estudio porque quiero conseguir un buen trabajo en el futuro.</p>',
'<p style="font-size:120%;">Yo estudio porque quiero conseguir una buena posición social en el futuro.']

var scale_inst = [
                '<p style="font-size:120%;">Nunca</p>',
                '<p style="font-size:120%;">Casi nunca</p>', 
                '<p style="font-size:120%;">Algunas veces</p>', 
                '<p style="font-size:120%;">Casi siempre</p>', 
                '<p style="font-size:120%;">Siempre</p>'
];

// Funcion que retorna la data de la sección de metas
function METAS_data_return() {
    // declaro la variable de datos
    var METAS_data = [];
    // agregar objetos
    for (i = 0; i < 20; i++) {
        METAS_data.push(
            {prompt: metas_preguntas[i], 
            name: ("Metas cuestionario pregunta").concat(i+1), 
            labels: scale_inst, 
            required: true}
        )
    }   
    return METAS_data;  
}





