// data enunciados
var enunciados_juego_normal = ["En la lista de palabras que viste,", "En la lista de palabras que viste,", "En la lista de palabras que viste,", "En la lista de palabras que viste,"];
var enunciados_juegos_negrita = ['<p style="font-weight: bold;font-size:120%;">¿cuál es la fruta que se mencionó?</p>', '<p style="font-weight: bold;font-size:120%;">¿cuál es el insecto que se mencionó? </p>', '<p style="font-weight: bold;font-size:120%;">¿cuál es el metal que se mencionó? </p>', '<p style="font-weight: bold;font-size:120%;">¿cuál es la profesión que se mencionó?</p>'];

// lista de permutaciones
var perm_inter = [[0, 1, 2, 3], [0, 1, 3, 2], [0, 2, 1, 3], [0, 2, 3, 1], [0, 3, 1, 2], [0, 3, 2, 1], [1, 0, 2, 3], [1, 0, 3, 2], [1, 2, 0, 3], [1, 2, 3, 0], [1, 3, 0, 2], [1, 3, 2, 0], [2, 0, 1, 3], [2, 0, 3, 1], [2, 1, 0, 3], [2, 1, 3, 0], [2, 3, 0, 1], [2, 3, 1, 0], [3, 0, 1, 2],  [3, 0, 2, 1], [3, 1, 0, 2], [3, 1, 2, 0], [3, 2, 0, 1], [3, 2, 1, 0]];

var opciones_clases_inter = [
    ["naranja", "saltamontes", "aluminio", "contador"],
    ["higo", "cigarra", "estaño", "conserje"],
    ["guayaba", "langosta", "cromo", "soldado"],
    ["durazno", "gorgojo", "wolframio", "inversionista"],
    ["plátano", "cucaracha", "plata", "dentista"]
    ];
// 0:correcta 1, 2 y 3 distractores debiles, 4 mejor distractor 
var condicion_list_inter = [[0,1,2,3,4], [0,4,1,2,3], [1,2,3,4,0], [4,1,2,3,0]];
    

// Funcion que retorna la condición indicada en su argumento (condicion en 0, ..., 23)
function INTER_data_condition(condicion) {
    // declaro la variable de datos
    var INTER_data = [];
    // declarar el orden de las condiciones
    var orden = perm_inter[condicion];
    
    // item es el numero del item
    for (item = 0; item < 4; item++) {
        // declarar condicion del item
        var cond_item = condicion_list_inter[orden[item]];
        
        // declaro la variable de datos para las opciones
        var data_opciones = [];
        // llenar la variable de data_opciones
        for (index_opcion = 0; index_opcion < 5; index_opcion++){
            data_opciones.push(opciones_clases_inter[cond_item[index_opcion]][item]);
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
    return INTER_data
}


