// variables para los grid
// horizontales
var grid_1_3 = [[1,1,1]];
// verticales
var grid_3_1 = [[1],[1],[1]];
var grid_3_3 = [[1,1,1],[1,1,1],[1,1,1]];
var grid_5_1 = [[1],[1],[1],[1],[1]];
var grid_6_1 = [[1],[1],[1],[1],[1],[1]];
var grid_3_2 = [[1,1],[1,1],[1,1]];
var grid_3_7 = [[1,1,1,1,1,1,1],[1,1,1,1,1,1,1],[1,1,1,1,1,1,1]];
var grid_7_2 = [[1,1],[1,1],[1,1],[1,1],[1,1],[1,1],[1,1]];
var grid_7_3 = [[1,1,1],[1,1,1],[1,1,1],[1,1,1],[1,1,1],[1,1,1],[1,1,1]];

// Juegos 1, 2, 3, 4, 7, 8
// variables para los enunciados
var juego_imagenes_pregunta_1 = ['<p style="font-size:120%;">Tienes que elegir una sola de estas cajitas<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál eliges?<br></p>',
'<p style="font-size:120%;">Un amigo te pide comprar una Pepsi. En el supermercado sólo quedan 3 botellas<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál llevas?<br><br></p>',
'<p style="font-size:120%;">Pasas a buscar a un amigo para que salgan al cine. Cuando llegas a su casa, tu amigo no está listo todavía, te pide que le esperes un ratito en la sala de estar.<br></p><p style="font-weight: bold;font-size:120%;">¿En cuál de estas sillas te sientas para esperar?<br><br></p>',
'<p style="font-size:120%;">Tienes que elegir uno de estos círculos.<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál eliges?<br><br></p>',
'<p style="font-size:120%;">En una sala de juegos, te dan el desafío de encontrar un tesoro escondido en una de estas cajas fuertes<br></p><p style="font-weight: bold;font-size:120%;">¿En cuál caja buscas el tesoro?<br><br></p>',
'<p style="font-size:120%;">Estás en un laberinto. Una sola puerta permite de salir, y tienes sólo un intento para encontrar la salida.<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál de estas puertas eliges abrir?<br><br></p>'];

// array de grids
var array_grid_1 = [grid_1_3, grid_1_3, grid_1_3, grid_3_1, grid_1_3, grid_1_3];

// variables para los nombres
var array_grid_images_1 = [ 
    [["Imagenes_juegos/imagen_juego_1.jpg", 
    "Imagenes_juegos/imagen_juego_1.jpg", 
    "Imagenes_juegos/imagen_juego_1.jpg"]],
    [["Imagenes_juegos/imagen_juego_2.jpg", 
    "Imagenes_juegos/imagen_juego_2.jpg", 
    "Imagenes_juegos/imagen_juego_2.jpg"]],
    [["Imagenes_juegos/imagen_juego_3.jpg", 
    "Imagenes_juegos/imagen_juego_3.jpg", 
    "Imagenes_juegos/imagen_juego_3.jpg"]],
    [["Imagenes_juegos/imagen_juego_4.jpg"], 
    ["Imagenes_juegos/imagen_juego_4.jpg"], 
    ["Imagenes_juegos/imagen_juego_4.jpg"]],
    [["Imagenes_juegos/imagen_juego_7.jpg", 
    "Imagenes_juegos/imagen_juego_7.jpg", 
    "Imagenes_juegos/imagen_juego_7.jpg"]],
    [["Imagenes_juegos/imagen_juego_88.jpg", 
    "Imagenes_juegos/imagen_juego_88.jpg", 
    "Imagenes_juegos/imagen_juego_88.jpg"]]
];

// variables para los tamaños en x e y
var array_size_x_1 = [200, 150, 200, 200, 200, 200];

var prop_1 = [72/71, 997/379, 348/176, 83/91, 1, 341/166];

var array_size_y_1 = [
    array_size_x_1[0]*prop_1[0],
    array_size_x_1[1]*prop_1[1],
    array_size_x_1[2]*prop_1[2],
    array_size_x_1[3]*prop_1[3],
    array_size_x_1[4]*prop_1[4],
    array_size_x_1[5]*prop_1[5]
];

// array para el espacio del borde
var array_border_1 = [10, 10, 10, 10, 10, 10]; 

// funcion que entrega los arrays para los casos simples

function juego_simple(i) {
    var data_juego = {
        type: 'serial-reaction-time-mouse', 
        allow_nontarget_responses: true,
        grid: array_grid_1[i],
        grid_images: array_grid_images_1[i],
        grid_allowed: array_grid_1[i],
        target: [0,2], 
        prompt: juego_imagenes_pregunta_1[i],
        border_spacing: array_border_1[i]
    }

    if (array_grid_1[i] == grid_1_3) {
        data_juego.grid_square_size_x = [[array_size_x_1[i],array_size_x_1[i],array_size_x_1[i]]];  
        data_juego.grid_square_size_y = [[array_size_y_1[i],array_size_y_1[i],array_size_y_1[i]]];
    }    

    else if (array_grid_1[i] == grid_3_1){
        data_juego.grid_square_size_x = [[array_size_x_1[i]],[array_size_x_1[i]],[array_size_x_1[i]]];  
        data_juego.grid_square_size_y = [[array_size_y_1[i]],[array_size_y_1[i]],[array_size_y_1[i]]];
    }    
      
    return data_juego
};

///////////////////////////////////////////////////////////////////////////////////////////////
// Juegos complejos verticales: 5, 6
// variables para los enunciados
var juego_imagenes_pregunta_2 = ['<p style="font-size:120%;">Tu tío te encarga comprar una Coca Cola. En el supermercado, el único estante con esta bebida es el que aparece en la foto<br></p><p style="font-weight: bold;font-size:120%;">¿De dónde sacas una botella?<br><br></p>',
'<p style="font-size:120%;">Tu celular ya no tiene batería, necesitas enchufarlo a la corriente lo antes posible<br></p><p style="font-weight: bold;font-size:120%;">¿En cuál de estos enchufes lo conectas?<br><br></p>'
];

// array de grids
var array_grid_2 = [grid_6_1, grid_7_3];
// array de grid_allowed
var allowed_grid_2 = [
    [[1],[0],[1],[0],[1],[0]], 
    [[0,0,0],[0,1,0],[0,0,0],[0,1,0],[0,0,0],[0,1,0],[0,0,0]]
];

// variables para los nombres
var array_grid_images_2 = [ 
    [["Imagenes_juegos/imagen_juego_5_1.png"],
    ["Imagenes_juegos/imagen_juego_5_2.png"],
    ["Imagenes_juegos/imagen_juego_5_3.png"],
    ["Imagenes_juegos/imagen_juego_5_4.png"],
    ["Imagenes_juegos/imagen_juego_5_5.png"],
    ["Imagenes_juegos/imagen_juego_5_6.png"]],
    
    [["Imagenes_juegos/Juego_6/imagen_juego_6_1.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_2.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_3.png"],
    ["Imagenes_juegos/Juego_6/imagen_juego_6_4.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_5.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_6.png"],
    ["Imagenes_juegos/Juego_6/imagen_juego_6_7.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_8.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_9.png"],
    ["Imagenes_juegos/Juego_6/imagen_juego_6_10.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_11.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_12.png"],
    ["Imagenes_juegos/Juego_6/imagen_juego_6_13.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_14.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_15.png"],
    ["Imagenes_juegos/Juego_6/imagen_juego_6_16.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_17.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_18.png"],
    ["Imagenes_juegos/Juego_6/imagen_juego_6_19.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_20.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_21.png"]]
];


// variables para los tamaños en x e y
var array_size_x_2 = [409, [78, 97, 75]];

var prop_2 = [
    [69/409, 28/409, 78/409, 30/409, 69/409, 42/409],
    
   [[78/78, 78/97, 78/75],
    [55/78, 55/97, 55/75],
    [6/78, 6/97, 6/75],
    [55/78, 55/97, 55/75],
    [6/78, 6/97, 6/75],
    [55/78, 55/97, 55/75],
    [78/78, 78/97, 78/75]] 
];

var array_size_y_2 = [
    [[array_size_x_2[0]*prop_2[0][0]],
     [array_size_x_2[0]*prop_2[0][1]], 
     [array_size_x_2[0]*prop_2[0][2]],
     [array_size_x_2[0]*prop_2[0][3]],
     [array_size_x_2[0]*prop_2[0][4]],
     [array_size_x_2[0]*prop_2[0][5]]],


    [[array_size_x_2[1][0]*prop_2[1][0][0],
    array_size_x_2[1][1]*prop_2[1][0][1],
    array_size_x_2[1][2]*prop_2[1][0][2]],
    [array_size_x_2[1][0]*prop_2[1][1][0],
    array_size_x_2[1][1]*prop_2[1][1][1],
    array_size_x_2[1][2]*prop_2[1][1][2]],
    [array_size_x_2[1][0]*prop_2[1][2][0],
    array_size_x_2[1][1]*prop_2[1][2][1],
    array_size_x_2[1][2]*prop_2[1][2][2]],
    [array_size_x_2[1][0]*prop_2[1][3][0],
    array_size_x_2[1][1]*prop_2[1][3][1],
    array_size_x_2[1][2]*prop_2[1][3][2]],
    [array_size_x_2[1][0]*prop_2[1][4][0],
    array_size_x_2[1][1]*prop_2[1][4][1],
    array_size_x_2[1][2]*prop_2[1][4][2]],
    [array_size_x_2[1][0]*prop_2[1][5][0],
    array_size_x_2[1][1]*prop_2[1][5][1],
    array_size_x_2[1][2]*prop_2[1][5][2]],
    [array_size_x_2[1][0]*prop_2[1][6][0],
    array_size_x_2[1][1]*prop_2[1][6][1],
    array_size_x_2[1][2]*prop_2[1][6][2]]]
];

// array para el espacio del borde
var array_border_2 = [0, 0]; 

// funcion que entrega los arrays para los casos simples

function juego_complex_v(i) {
    var data_juego = {
        type: 'serial-reaction-time-mouse', 
        allow_nontarget_responses: true,
        grid: array_grid_2[i],
        grid_images: array_grid_images_2[i],
        grid_allowed: allowed_grid_2[i],  
        target: [0,0], 
        prompt: juego_imagenes_pregunta_2[i],
        border_spacing: array_border_2[i],  
        grid_square_size_y : array_size_y_2[i]    
    }   
    if (i ==0){
        data_juego.grid_square_size_x = [
            [array_size_x_2[i]],
            [array_size_x_2[i]],
            [array_size_x_2[i]],
            [array_size_x_2[i]],
            [array_size_x_2[i]],
            [array_size_x_2[i]]
        ]
    } else if (i==1){
        data_juego.grid_square_size_x = [
            [array_size_x_2[i][0],array_size_x_2[i][1],array_size_x_2[i][2]],
            [array_size_x_2[i][0],array_size_x_2[i][1],array_size_x_2[i][2]],
            [array_size_x_2[i][0],array_size_x_2[i][1],array_size_x_2[i][2]],
            [array_size_x_2[i][0],array_size_x_2[i][1],array_size_x_2[i][2]],
            [array_size_x_2[i][0],array_size_x_2[i][1],array_size_x_2[i][2]],
            [array_size_x_2[i][0],array_size_x_2[i][1],array_size_x_2[i][2]],
            [array_size_x_2[i][0],array_size_x_2[i][1],array_size_x_2[i][2]]
        ]
    }

    return data_juego
};

///////////////////////////////////////////////////////////////////////////////////////////////
// Juegos complejos horizontales: 9 11 
// variables para los enunciados
var juego_imagenes_pregunta_3 = ['<p style="font-size:120%;">En un juego callejero, un hombre coloca una bolita bajo uno de estos vasos y luego los cambia de posición rápidamente. Te pide que le indiques bajo qué vaso se encuentra la bolita.<br></p><p style="font-weight: bold;font-size:120%;">¿Bajo cuál vaso crees que está la bolita?<br><br></p>',
'<p style="font-size:120%;">Imagina que trabajas en selección de personal. Tienes que seleccionar 1 de los 3 candidatos que están sentados en las sillas que se muestran a continuación<br></p><p style="font-weight: bold; font-size:120%;">¿En qué silla piensas que el mejor candidato está sentado?<br><br></p>'
];
// array de grids
var array_grid_3 = [grid_1_3, grid_1_3];

var allowed_grid_3 = [
[[1,1,1]],

[[1,1,1]]
];
// variables para los nombres
var array_grid_images_3 = [ 
    [["Imagenes_juegos/imagen_juego_9.jpg", 
    "Imagenes_juegos/imagen_juego_9.jpg",
    "Imagenes_juegos/imagen_juego_9.jpg"]],

    [["Imagenes_juegos/imagen_juego_11_1.jpg",
    "Imagenes_juegos/imagen_juego_11_1.jpg",
    "Imagenes_juegos/imagen_juego_11_1.jpg"]]
];
// variables para los tamaños en x e y
var array_size_y_3 = [[146*1.5], [231]];

var prop_3 = [
    [[101/146, 101/146, 101/146]]
];

var array_size_x_3 = [
    [[array_size_y_3[0][0]*prop_3[0][0][0],
    array_size_y_3[0][0]*prop_3[0][0][1],
    array_size_y_3[0][0]*prop_3[0][0][2]]],

    [[165, 165, 165]]


];

// array para el espacio del borde
var array_border_3 = [20, 20]; 

// funcion que entrega los arrays para los casos simples

function juego_complex_h(i) {
    var data_juego = {
        type: 'serial-reaction-time-mouse', 
        allow_nontarget_responses: true,
        grid: array_grid_3[i],
        grid_images: array_grid_images_3[i],
        grid_allowed: allowed_grid_3[i],
        target: [0,0], 
        prompt: juego_imagenes_pregunta_3[i],
        border_spacing: array_border_3[i],
        grid_square_size_x : array_size_x_3[i]
        
    }    
     if (i == 0) {
        data_juego.grid_square_size_y = [[
            array_size_y_3[i][0],
            array_size_y_3[i][0],
            array_size_y_3[i][0]
        ]]
        
     } else {
        data_juego.grid_square_size_y = [[
            array_size_y_3[i][0], 
            array_size_y_3[i][0],
            array_size_y_3[i][0]
        ]];
     }
     console.log(data_juego)
    return data_juego
};

///////////////////////////////////////////////////////////////////////////////////////////////
// Juegos complejos horizontales: 12 13 14 15 10

// variables para los enunciados
var juego_imagenes_pregunta_4 = ['<p style="font-size:120%;">Vas a la farmacia a comprar vitaminas. Te presentan estos  productos multivitamínicos que son nuevos en el mercado<br></p><p style="font-weight: bold;font-size:120%;">¿cuál eliges?<br><br></p>',
'<p style="font-size:120%;">Hay elecciones presidenciales en Ucrania <br></p><p style="font-weight: bold;font-size:120%;">¿Por cuál de estos candidatos votarías tú?<br><br></p>',
'<p style="font-size:120%;">Si ganarás un viaje a Estados Unidos,<br></p><p style="font-weight: bold;font-size:120%;">¿en cuál de estos hoteles alojarías?<br><br></p>',
'<p style="font-size:120%;">Te invitan a un restaurante finés<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál de estos platos típicos eliges para probar?<br><br></p>',
'<p style="font-size:120%;">Un equipo de trabajo está entrando a una sala de reunión. Son 6 trabajadores y hay 6 sillas<br></p><p style="font-weight: bold;font-size:120%;">¿En qué silla crees que se sentará el trabajador con mayor años de antigüedad en el equipo?<br><br></p>'
];

// array de grids
var array_grid_4 = [grid_1_3, grid_7_3, grid_7_2, grid_7_2, grid_3_3];
// array de grid_allowed
var allowed_grid_4 = [
    grid_1_3, 
    [[0,0,0],[0,1,0],[0,0,0],[0,1,0],[0,0,0],[0,1,0],[0,0,0]], 
    [[0,0],[0,1],[0,0],[0,1],[0,0],[0,1],[0,0]], 
    [[0,0],[0,1],[0,0],[0,1],[0,0],[0,1],[0,0]],
    [[1,0,1],[1,0,1],[1,0,1]]
];

// variables para los nombres
var array_grid_images_4 = [ 
    ["Imagenes_juegos/imagen_juego_12_1.jpg", 
    "Imagenes_juegos/imagen_juego_12_2.jpg", 
    "Imagenes_juegos/imagen_juego_12_3.jpg"],

    ["Imagenes_juegos/imagen_juego_13_1.jpg", 
    "Imagenes_juegos/imagen_juego_13_2.jpg", 
    "Imagenes_juegos/imagen_juego_13_3.jpg",
    "Imagenes_juegos/imagen_juego_13_4.jpg",
    "Imagenes_juegos/imagen_juego_13_5.jpg",
    "Imagenes_juegos/imagen_juego_13_6.jpg",
    "Imagenes_juegos/imagen_juego_13_7.jpg",
    "Imagenes_juegos/imagen_juego_13_8.jpg",
    "Imagenes_juegos/imagen_juego_13_9.jpg",
    "Imagenes_juegos/imagen_juego_13_10.jpg",
    "Imagenes_juegos/imagen_juego_13_11.jpg",
    "Imagenes_juegos/imagen_juego_13_12.jpg",
    "Imagenes_juegos/imagen_juego_13_13.jpg",
    "Imagenes_juegos/imagen_juego_13_14.jpg",
    "Imagenes_juegos/imagen_juego_13_15.jpg",
    "Imagenes_juegos/imagen_juego_13_16.jpg",
    "Imagenes_juegos/imagen_juego_13_17.jpg",
    "Imagenes_juegos/imagen_juego_13_18.jpg",
    "Imagenes_juegos/imagen_juego_13_19.jpg",
    "Imagenes_juegos/imagen_juego_13_20.jpg",
    "Imagenes_juegos/imagen_juego_13_21.jpg"],

    ["Imagenes_juegos/imagen_juego_14_1_1.png", 
    "Imagenes_juegos/imagen_juego_14_1_2.png",
    "Imagenes_juegos/imagen_juego_14_1_3.png",

    ["Imagenes_juegos/imagen_juego_14_1_4.png",
    "Imagenes_juegos/imagen_juego_14_2_4.png",
    "Imagenes_juegos/imagen_juego_14_3_4.png",
    "Imagenes_juegos/imagen_juego_14_4_4.png",
    "Imagenes_juegos/imagen_juego_14_5_4.png",
    "Imagenes_juegos/imagen_juego_14_6_4.png"],

    "Imagenes_juegos/imagen_juego_14_1_5.png",
    "Imagenes_juegos/imagen_juego_14_1_6.png",
    "Imagenes_juegos/imagen_juego_14_1_7.png",

    ["Imagenes_juegos/imagen_juego_14_1_8.png",
    "Imagenes_juegos/imagen_juego_14_2_8.png",
    "Imagenes_juegos/imagen_juego_14_3_8.png",
    "Imagenes_juegos/imagen_juego_14_4_8.png",
    "Imagenes_juegos/imagen_juego_14_5_8.png",
    "Imagenes_juegos/imagen_juego_14_6_8.png"],

    "Imagenes_juegos/imagen_juego_14_1_9.png",
    "Imagenes_juegos/imagen_juego_14_1_10.png",
    "Imagenes_juegos/imagen_juego_14_1_11.png",
    
    ["Imagenes_juegos/imagen_juego_14_1_12.png",
    "Imagenes_juegos/imagen_juego_14_2_12.png",
    "Imagenes_juegos/imagen_juego_14_3_12.png",
    "Imagenes_juegos/imagen_juego_14_4_12.png",
    "Imagenes_juegos/imagen_juego_14_5_12.png",
    "Imagenes_juegos/imagen_juego_14_6_12.png"],

    "Imagenes_juegos/imagen_juego_14_1_13.png",
    "Imagenes_juegos/imagen_juego_14_1_14.png"],

    ["Imagenes_juegos/imagen_juego_15_1_1.png", 
    "Imagenes_juegos/imagen_juego_15_1_2.png", 
    "Imagenes_juegos/imagen_juego_15_1_3.png",

    ["Imagenes_juegos/imagen_juego_15_1_4.png",
    "Imagenes_juegos/imagen_juego_15_2_4.png",
    "Imagenes_juegos/imagen_juego_15_3_4.png",
    "Imagenes_juegos/imagen_juego_15_4_4.png",
    "Imagenes_juegos/imagen_juego_15_5_4.png",
    "Imagenes_juegos/imagen_juego_15_6_4.png"],

    "Imagenes_juegos/imagen_juego_15_1_5.png", 
    "Imagenes_juegos/imagen_juego_15_1_6.png",
    "Imagenes_juegos/imagen_juego_15_1_7.png",

    ["Imagenes_juegos/imagen_juego_15_1_8.png",
    "Imagenes_juegos/imagen_juego_15_2_8.png",
    "Imagenes_juegos/imagen_juego_15_3_8.png",
    "Imagenes_juegos/imagen_juego_15_4_8.png",
    "Imagenes_juegos/imagen_juego_15_5_8.png",
    "Imagenes_juegos/imagen_juego_15_6_8.png"],

    "Imagenes_juegos/imagen_juego_15_1_9.png",
    "Imagenes_juegos/imagen_juego_15_1_10.png",
    "Imagenes_juegos/imagen_juego_15_1_11.png",

    ["Imagenes_juegos/imagen_juego_15_1_12.png",
    "Imagenes_juegos/imagen_juego_15_2_12.png",
    "Imagenes_juegos/imagen_juego_15_3_12.png",
    "Imagenes_juegos/imagen_juego_15_4_12.png",
    "Imagenes_juegos/imagen_juego_15_5_12.png",
    "Imagenes_juegos/imagen_juego_15_6_12.png"],

    "Imagenes_juegos/imagen_juego_15_1_13.png",
    "Imagenes_juegos/imagen_juego_15_1_14.png"],

    ["Imagenes_juegos/imagen_juego_10_1.jpg",
    "Imagenes_juegos/imagen_juego_10_2.jpg",
    "Imagenes_juegos/imagen_juego_10_3.jpg",
    "Imagenes_juegos/imagen_juego_10_4.jpg",
    "Imagenes_juegos/imagen_juego_10_5.jpg",
    "Imagenes_juegos/imagen_juego_10_6.jpg",
    "Imagenes_juegos/imagen_juego_10_7.jpg",
    "Imagenes_juegos/imagen_juego_10_8.jpg",
    "Imagenes_juegos/imagen_juego_10_9.jpg"]
];

// orden de las distintas condiciones
var perm = [
    [0,1,2],
    [0,2,1],
    [1,0,2],
    [1,2,0],
    [2,0,1],
    [2,1,0]
];

// variables para los tamaños en x e y
var array_size_x_4 = [200, [22,307,40], [13,228], [320, 247], [100,130,102]
];

var prop_4 = [
    [209/133, 209/133, 209/133],
    [[45/22, 45/307, 45/40],
    [34/22, 34/307, 34/40],
    [17/22, 17/307, 17/40],
    [35/22, 35/307, 35/40],
    [16/22, 16/307, 16/40],
    [34/22, 34/307, 34/40],
    [99/22, 99/307, 99/40]],
    
    [1,1,1], 
    [1,1,1]
];

function array_size_y_4(i, cond){
    var orden = perm[cond-1];
    if (i == 0) {
        return [[
            array_size_x_4[0]*prop_4[0][0],
            array_size_x_4[0]*prop_4[0][1], 
            array_size_x_4[0]*prop_4[0][2],
           
        ]]

    } else if (i == 1) {
        return [
            [array_size_x_4[i][0]*prop_4[i][0][0],array_size_x_4[i][1]*prop_4[i][0][1],array_size_x_4[i][2]*prop_4[i][0][2]],
            [array_size_x_4[i][0]*prop_4[i][1][0],array_size_x_4[i][1]*prop_4[i][1][1],array_size_x_4[i][2]*prop_4[i][1][2]],
            [array_size_x_4[i][0]*prop_4[i][2][0],array_size_x_4[i][1]*prop_4[i][2][1],array_size_x_4[i][2]*prop_4[i][2][2]],
            [array_size_x_4[i][0]*prop_4[i][3][0],array_size_x_4[i][1]*prop_4[i][3][1],array_size_x_4[i][2]*prop_4[i][3][2]],
            [array_size_x_4[i][0]*prop_4[i][4][0],array_size_x_4[i][1]*prop_4[i][4][1],array_size_x_4[i][2]*prop_4[i][4][2]],
            [array_size_x_4[i][0]*prop_4[i][5][0],array_size_x_4[i][1]*prop_4[i][5][1],array_size_x_4[i][2]*prop_4[i][5][2]],
            [array_size_x_4[i][0]*prop_4[i][6][0],array_size_x_4[i][1]*prop_4[i][6][1],array_size_x_4[i][2]*prop_4[i][6][2]],
        ]

    } else if (i == 2) {
        return [
            [135, 135],
            [30,  30],
            [23,  23],
            [30,  30],
            [21,  21],
            [30,  30],
            [48,  48]
        ];

    } else if (i == 3) {
        return [
            [154, 154],
            [38, 38],
            [35, 35],
            [38, 38],
            [34, 34],
            [38, 38],
            [199,199]
        ];
    } else if (i == 4) {
        return [
            [100, 100, 100],
            [87, 87, 87],
            [143, 143, 143]
        ];
    }
}

// array para el espacio del borde
var array_border_4 = [20, 0, 0, 0, 0]; 


// Función que toma una array de la forma 1_3 o 3_1 y devuelve un array 
// que representa la condicion
function array_cond(lista_imagenes, cond, index_item) {
    var orden = perm[cond-1];
    if (index_item == 0) {
        var result = [[
            lista_imagenes[orden[0]], 
            lista_imagenes[orden[1]], 
            lista_imagenes[orden[2]]
        ]];           
    } else if (index_item == 1) {
        var result = [
            [lista_imagenes[0],lista_imagenes[1],lista_imagenes[2]],
            [lista_imagenes[3],lista_imagenes[4],lista_imagenes[5]],
            [lista_imagenes[6],lista_imagenes[7],lista_imagenes[8]],
            [lista_imagenes[9],lista_imagenes[10],lista_imagenes[11]],
            [lista_imagenes[12],lista_imagenes[13],lista_imagenes[14]],
            [lista_imagenes[15],lista_imagenes[16],lista_imagenes[17]],
            [lista_imagenes[18],lista_imagenes[19],lista_imagenes[20]],


        ]
    } else if (index_item == 2 || index_item == 3) {
        var result = [
            [array_grid_images_4[index_item][0],array_grid_images_4[index_item][1]],
            [array_grid_images_4[index_item][2],array_grid_images_4[index_item][3][cond-1]],
            [array_grid_images_4[index_item][4],array_grid_images_4[index_item][5]],
            [array_grid_images_4[index_item][6],array_grid_images_4[index_item][7][cond-1]],
            [array_grid_images_4[index_item][8],array_grid_images_4[index_item][9]],
            [array_grid_images_4[index_item][10],array_grid_images_4[index_item][11][cond-1]],
            [array_grid_images_4[index_item][12],array_grid_images_4[index_item][13]]
        ]
    } else if (index_item == 4) {
        var result = [
            [lista_imagenes[0],lista_imagenes[1], lista_imagenes[2]],
            [lista_imagenes[3],lista_imagenes[4], lista_imagenes[5]],
            [lista_imagenes[6],lista_imagenes[7], lista_imagenes[8]]
        ]
    }
    return result
};

// funcion que entrega los arrays para los casos simples
function juego_cond(i, cond) {
    var data_juego = {
        type: 'serial-reaction-time-mouse', 
        allow_nontarget_responses: true,
        grid: array_grid_4[i],
        grid_allowed: allowed_grid_4[i],  
        target: [0,0], 
        prompt: juego_imagenes_pregunta_4[i],
        border_spacing: array_border_4[i],
        grid_images: array_cond(array_grid_images_4[i], cond, i),  
        grid_square_size_y : array_size_y_4(i, cond)
        
    } 
     
    if (i == 0){
        data_juego.grid_square_size_x = [[array_size_x_4[i],array_size_x_4[i],array_size_x_4[i]]];
    } else if (i == 1){
        data_juego.grid_square_size_x = [[array_size_x_4[i][0],array_size_x_4[i][1],array_size_x_4[i][2]],
        [array_size_x_4[i][0],array_size_x_4[i][1],array_size_x_4[i][2]],
        [array_size_x_4[i][0],array_size_x_4[i][1],array_size_x_4[i][2]],
        [array_size_x_4[i][0],array_size_x_4[i][1],array_size_x_4[i][2]],
        [array_size_x_4[i][0],array_size_x_4[i][1],array_size_x_4[i][2]],
        [array_size_x_4[i][0],array_size_x_4[i][1],array_size_x_4[i][2]],
        [array_size_x_4[i][0],array_size_x_4[i][1],array_size_x_4[i][2]]
    
    ];
        
    } else if (i == 2 || i == 3){
        data_juego.grid_square_size_x = [array_size_x_4[i],array_size_x_4[i],array_size_x_4[i],array_size_x_4[i], array_size_x_4[i], array_size_x_4[i], array_size_x_4[i]];
    } else if (i == 4){
        data_juego.grid_square_size_x = [
            [array_size_x_4[i][0],
        array_size_x_4[i][1], 
        array_size_x_4[i][2]],[array_size_x_4[i][0],
        array_size_x_4[i][1], 
        array_size_x_4[i][2]],[array_size_x_4[i][0],
        array_size_x_4[i][1], 
        array_size_x_4[i][2]]
        
    ]; 
    }  

    return data_juego
};

// funcion general que entrega cada uno de los juegos
function juego_data_condition(i, condicion) {
    if (i == 1){
        var result = juego_simple(0); 
    } else if (i == 2){
        var result = juego_simple(1);
    } else if (i == 3){
        var result = juego_simple(2);
    } else if (i == 4){
        var result = juego_simple(3);
    } else if (i == 5){
        var result = juego_complex_v(0);
    } else if (i == 6){
        var result = juego_complex_v(1);
    } else if (i == 7){
        var result = juego_simple(4);
    } else if (i == 8){
        var result = juego_simple(5);
    } else if (i == 9){
        var result = juego_complex_h(0);
    } else if (i == 10){
        var result = juego_cond(4, 1);
    } else if (i == 11){
        var result = juego_complex_h(1);
    } else if (i == 12){
        var result = juego_cond(0, condicion);
    } else if (i == 13){
        var result = juego_cond(1, condicion);
    } else if (i == 14){
        var result = juego_cond(2, condicion);
    } else if (i == 15){
        var result = juego_cond(3, condicion);
    }
    result.data = {juego: i};
    return result 
}


// Variable para la precarga de las imagenes
var todas_imagenes = [ 
    "Imagenes_juegos/imagen_juego_1.jpg", 
    "Imagenes_juegos/imagen_juego_1.jpg", 
    "Imagenes_juegos/imagen_juego_1.jpg",
    "Imagenes_juegos/imagen_juego_2.jpg", 
    "Imagenes_juegos/imagen_juego_2.jpg", 
    "Imagenes_juegos/imagen_juego_2.jpg",
    "Imagenes_juegos/imagen_juego_3.jpg", 
    "Imagenes_juegos/imagen_juego_3.jpg", 
    "Imagenes_juegos/imagen_juego_3.jpg",
    "Imagenes_juegos/imagen_juego_4.jpg", 
    "Imagenes_juegos/imagen_juego_4.jpg", 
    "Imagenes_juegos/imagen_juego_4.jpg",
    "Imagenes_juegos/imagen_juego_7.jpg", 
    "Imagenes_juegos/imagen_juego_7.jpg", 
    "Imagenes_juegos/imagen_juego_7.jpg",
    "Imagenes_juegos/imagen_juego_88.jpg", 
    "Imagenes_juegos/imagen_juego_88.jpg", 
    "Imagenes_juegos/imagen_juego_88.jpg",
    "Imagenes_juegos/imagen_juego_5_1.png",
    "Imagenes_juegos/imagen_juego_5_2.png",
    "Imagenes_juegos/imagen_juego_5_3.png",
    "Imagenes_juegos/imagen_juego_5_4.png",
    "Imagenes_juegos/imagen_juego_5_5.png",
    "Imagenes_juegos/imagen_juego_5_6.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_1.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_2.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_3.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_4.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_5.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_6.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_7.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_8.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_9.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_10.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_11.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_12.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_13.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_14.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_15.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_16.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_17.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_18.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_19.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_20.png",
    "Imagenes_juegos/Juego_6/imagen_juego_6_21.png",
    "Imagenes_juegos/imagen_juego_9.jpg", 
    "Imagenes_juegos/imagen_juego_9.jpg",
    "Imagenes_juegos/imagen_juego_9.jpg",
    "Imagenes_juegos/imagen_juego_11_1.jpg",
    "Imagenes_juegos/imagen_juego_12_1.jpg", 
    "Imagenes_juegos/imagen_juego_12_2.jpg", 
    "Imagenes_juegos/imagen_juego_12_3.jpg",
    "Imagenes_juegos/imagen_juego_13_1.jpg", 
    "Imagenes_juegos/imagen_juego_13_2.jpg", 
    "Imagenes_juegos/imagen_juego_13_3.jpg",
    "Imagenes_juegos/imagen_juego_13_4.jpg",
    "Imagenes_juegos/imagen_juego_13_5.jpg",
    "Imagenes_juegos/imagen_juego_13_6.jpg",
    "Imagenes_juegos/imagen_juego_13_7.jpg",
    "Imagenes_juegos/imagen_juego_13_8.jpg",
    "Imagenes_juegos/imagen_juego_13_9.jpg",
    "Imagenes_juegos/imagen_juego_13_10.jpg",
    "Imagenes_juegos/imagen_juego_13_11.jpg",
    "Imagenes_juegos/imagen_juego_13_12.jpg",
    "Imagenes_juegos/imagen_juego_13_13.jpg",
    "Imagenes_juegos/imagen_juego_13_14.jpg",
    "Imagenes_juegos/imagen_juego_13_15.jpg",
    "Imagenes_juegos/imagen_juego_13_16.jpg",
    "Imagenes_juegos/imagen_juego_13_17.jpg",
    "Imagenes_juegos/imagen_juego_13_18.jpg",
    "Imagenes_juegos/imagen_juego_13_19.jpg",
    "Imagenes_juegos/imagen_juego_13_20.jpg",
    "Imagenes_juegos/imagen_juego_13_21.jpg",
    "Imagenes_juegos/imagen_juego_14_1_1.png", 
    "Imagenes_juegos/imagen_juego_14_1_2.png",
    "Imagenes_juegos/imagen_juego_14_1_3.png",
    "Imagenes_juegos/imagen_juego_14_1_4.png",
    "Imagenes_juegos/imagen_juego_14_2_4.png",
    "Imagenes_juegos/imagen_juego_14_3_4.png",
    "Imagenes_juegos/imagen_juego_14_4_4.png",
    "Imagenes_juegos/imagen_juego_14_5_4.png",
    "Imagenes_juegos/imagen_juego_14_6_4.png",
    "Imagenes_juegos/imagen_juego_14_1_5.png",
    "Imagenes_juegos/imagen_juego_14_1_6.png",
    "Imagenes_juegos/imagen_juego_14_1_7.png",
    "Imagenes_juegos/imagen_juego_14_1_8.png",
    "Imagenes_juegos/imagen_juego_14_2_8.png",
    "Imagenes_juegos/imagen_juego_14_3_8.png",
    "Imagenes_juegos/imagen_juego_14_4_8.png",
    "Imagenes_juegos/imagen_juego_14_5_8.png",
    "Imagenes_juegos/imagen_juego_14_6_8.png",
    "Imagenes_juegos/imagen_juego_14_1_9.png",
    "Imagenes_juegos/imagen_juego_14_1_10.png",
    "Imagenes_juegos/imagen_juego_14_1_11.png",
    "Imagenes_juegos/imagen_juego_14_1_12.png",
    "Imagenes_juegos/imagen_juego_14_2_12.png",
    "Imagenes_juegos/imagen_juego_14_3_12.png",
    "Imagenes_juegos/imagen_juego_14_4_12.png",
    "Imagenes_juegos/imagen_juego_14_5_12.png",
    "Imagenes_juegos/imagen_juego_14_6_12.png",
    "Imagenes_juegos/imagen_juego_14_1_13.png",
    "Imagenes_juegos/imagen_juego_14_1_14.png",
    "Imagenes_juegos/imagen_juego_15_1_1.png", 
    "Imagenes_juegos/imagen_juego_15_1_2.png", 
    "Imagenes_juegos/imagen_juego_15_1_3.png",
    "Imagenes_juegos/imagen_juego_15_1_4.png",
    "Imagenes_juegos/imagen_juego_15_2_4.png",
    "Imagenes_juegos/imagen_juego_15_3_4.png",
    "Imagenes_juegos/imagen_juego_15_4_4.png",
    "Imagenes_juegos/imagen_juego_15_5_4.png",
    "Imagenes_juegos/imagen_juego_15_6_4.png",
    "Imagenes_juegos/imagen_juego_15_1_5.png", 
    "Imagenes_juegos/imagen_juego_15_1_6.png",
    "Imagenes_juegos/imagen_juego_15_1_7.png",
    "Imagenes_juegos/imagen_juego_15_1_8.png",
    "Imagenes_juegos/imagen_juego_15_2_8.png",
    "Imagenes_juegos/imagen_juego_15_3_8.png",
    "Imagenes_juegos/imagen_juego_15_4_8.png",
    "Imagenes_juegos/imagen_juego_15_5_8.png",
    "Imagenes_juegos/imagen_juego_15_6_8.png",
    "Imagenes_juegos/imagen_juego_15_1_9.png",
    "Imagenes_juegos/imagen_juego_15_1_10.png",
    "Imagenes_juegos/imagen_juego_15_1_11.png",
    "Imagenes_juegos/imagen_juego_15_1_12.png",
    "Imagenes_juegos/imagen_juego_15_2_12.png",
    "Imagenes_juegos/imagen_juego_15_3_12.png",
    "Imagenes_juegos/imagen_juego_15_4_12.png",
    "Imagenes_juegos/imagen_juego_15_5_12.png",
    "Imagenes_juegos/imagen_juego_15_6_12.png",
    "Imagenes_juegos/imagen_juego_15_1_13.png",
    "Imagenes_juegos/imagen_juego_15_1_14.png",
    "Imagenes_juegos/imagen_juego_10_1.jpg",
    "Imagenes_juegos/imagen_juego_10_2.jpg",
    "Imagenes_juegos/imagen_juego_10_3.jpg",
    "Imagenes_juegos/imagen_juego_10_4.jpg",
    "Imagenes_juegos/imagen_juego_10_5.jpg",
    "Imagenes_juegos/imagen_juego_10_6.jpg",
    "Imagenes_juegos/imagen_juego_10_7.jpg",
    "Imagenes_juegos/imagen_juego_10_8.jpg",
    "Imagenes_juegos/imagen_juego_10_9.jpg",
    "imagen_juego_interferencia.jpg"];