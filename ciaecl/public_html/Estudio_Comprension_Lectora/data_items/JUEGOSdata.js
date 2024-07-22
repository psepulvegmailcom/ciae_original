// data enunciados
var enunciados_juego_normal = ["En la lista de palabras que viste,", "En la lista de palabras que viste,", "En la lista de palabras que viste,", "En la lista de palabras que viste,"];
var enunciados_juegos_negrita = ['<p style="font-weight: bold;font-size:120%;">¿cuál es la fruta que se mencionó?</p>', '<p style="font-weight: bold;font-size:120%;">¿cuál es el insecto que se mencionó? </p>', '<p style="font-weight: bold;font-size:120%;">¿cuál es el metal que se mencionó? </p>', '<p style="font-weight: bold;font-size:120%;">¿cuál es la profesión que se mencionó?</p>'];

// lista de permutaciones
var perm_inter = [[0, 1, 2, 3], [0, 1, 3, 2], [0, 2, 1, 3], [0, 2, 3, 1], [0, 3, 1, 2], [0, 3, 2, 1], [1, 0, 2, 3], [1, 0, 3, 2], [1, 2, 0, 3], [1, 2, 3, 0], [1, 3, 0, 2], [1, 3, 2, 0], [2, 0, 1, 3], [2, 0, 3, 1], [2, 1, 0, 3], [2, 1, 3, 0], [2, 3, 0, 1], [2, 3, 1, 0], [3, 0, 1, 2],  [3, 0, 2, 1], [3, 1, 0, 2], [3, 1, 2, 0], [3, 2, 0, 1], [3, 2, 1, 0]];

// Data opciones por tipo de opcion (correcta = 0, mejor distractor = 1, distractor debil = 2)

var opciones_clases = [
    ["naranja", "saltamontes", "aluminio", "contador"],
    ["plátano", "cucaracha", "plata", "dentista"],
    ["mango", "cigarra", "estaño", "conserje"]
];

// Orden de cada condicion 
var condicion_list = [[0,2,1], [0,1,2], [2,1,0], [1,2,0]];

// Funcion que retorna la condición indicada en su argumento (condicion en 0, ..., 23)
function INTER_data_condition(inter_condicion) {
    // declaro la variable de datos
    var INTER_data = [];
    // declarar el orden de las condiciones
    var orden = perm_inter[inter_condicion];
    
    // i es el numero del item
    for (item = 0; item < 4; item++) {
        // declarar condicion del item
        var cond_item = condicion_list[orden[item]];
        // declaro la variable de datos para las opciones
        var data_opciones = [];

        // llenar la variable de data_opciones
        for (index_opcion = 0; index_opcion < 3; index_opcion++){
            console.log(opciones_clases[cond_item[index_opcion]])
            data_opciones.push(opciones_clases[cond_item[index_opcion]][item]);
        }
        // agregar objeto questions a la lista MCQ data interferencia
        INTER_data.push(
            {questions: 
            [{prompt: '<p style="font-size:120%">'+(enunciados_juego_normal[item])+ '<br><span style:"font-weight:bold;">'+ enunciados_juegos_negrita[item] + '</span></p>', 
            name: 'pregunta interferencia'.concat((item+1).toString()), 
            options: data_opciones,
            required:true}]}
        )
    }   
    return INTER_data;  
};