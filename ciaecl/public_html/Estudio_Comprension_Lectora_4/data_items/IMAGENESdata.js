// lista de permutaciones
var perm = [[0, 1, 2, 3], [0, 1, 3, 2], [0, 2, 1, 3], [0, 2, 3, 1], [0, 3, 1, 2], [0, 3, 2, 1], [1, 0, 2, 3], [1, 0, 3, 2], [1, 2, 0, 3], [1, 2, 3, 0], [1, 3, 0, 2], [1, 3, 2, 0], [2, 0, 1, 3], [2, 0, 3, 1], [2, 1, 0, 3], [2, 1, 3, 0], [2, 3, 0, 1], [2, 3, 1, 0], [3, 0, 1, 2], [3, 0, 2, 1], [3, 1, 0, 2], [3, 1, 2, 0], [3, 2, 0, 1], [3, 2, 1, 0]];

// funcion de asignacion de condiciones
function asig_cond(index, list_imagenes, cond) {
    var list_img_condition = [];
    if (index == 13 || index == 14) {
        for (i = 0; i < 36; i++) {
            // Agregar imagen a la lista 
            if ((i == 6)||(i == 14)||(i == 22)||(i == 30)){
                list_img_condition.push(list_imagenes[(perm[cond-1][(i-6)/8])*8+6]);
            } else {
                list_img_condition.push(list_imagenes[i]);
            };
        };
    } else if (index == 12) {
        for (i = 0; i < 27; i++) {
            // Agregar imagen a la lista 
            if ((i == 4)||(i == 10)||(i == 16)||(i == 22)){
                list_img_condition.push(list_imagenes[(perm[cond-1][(i-4)/6])*6+4]);
            } else {
                list_img_condition.push(list_imagenes[i]);
            };
        };
    } else if (index == 11) {
        for (i = 0; i < 4; i++){
            list_img_condition.push(list_imagenes[perm[cond-1][i]]);
        };
    };
    return list_img_condition
};

// funcion que genera un arreglo con las dimensiones asociadas
function grid_generator(dim_x, dim_y, element_list, factor = 0, cond = [0, 0]){
    var grid = [];
    count = 0;
    for(var i=0; i<dim_x; i++){
        grid.push([]);
        for(var j=0; j<dim_y; j++){
            if (factor > 0){
                grid[i].push(element_list[count]*factor);
            } else if (cond[0] == 11 || cond[0] == 12 || cond[0] == 13 || cond[0] == 14){
                grid[i].push(asig_cond(cond[0], element_list, cond[1])[count]);
            } else {
                grid[i].push(element_list[count]);
            }
            count++;
        }
    }
    return grid
};

// lista para las variables de grid
var grid_list = [
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(4, 1, [...Array(1*4).keys()].fill(1)),
    grid_generator(9, 3, [...Array(9*3).keys()].fill(1)),
    grid_generator(9, 3, [...Array(9*3).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(9, 3, [...Array(9*3).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(9, 3, [...Array(9*3).keys()].fill(1)),
    grid_generator(9, 4, [...Array(9*4).keys()].fill(1)),
    grid_generator(9, 4, [...Array(9*4).keys()].fill(1))
]; 

// lista para las variables de grid allowed
var grid_allowed_list = [
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(4, 1, [...Array(1*4).keys()].fill(1)),
    grid_generator(9, 3, [0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0]),
    grid_generator(9, 3, [0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0]),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(9, 3, [0,0,0,1,0,1,0,0,0,1,0,1,0,0,0,1,0,1,0,0,0,1,0,1,0,0,0]),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(1)),
    grid_generator(9, 3, [0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0]),
    grid_generator(9, 4, [0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0]),
    grid_generator(9, 4, [0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0,0,1,1,0,0,0,0,0])
]; 

// lista para las dimensiones en x 
var x_size_list = [
    grid_generator(1, 4, [...Array(1*4).keys()].fill(71), 3),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(379), 200/379),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(176), 1),
    grid_generator(4, 1, [...Array(1*4).keys()].fill(91), 1.5),
    grid_generator(9, 3, [139, 40, 132, 139, 40, 132, 139, 40, 132, 139, 40, 132, 139, 40, 132, 139, 40, 132, 139, 40, 132, 139, 40, 132, 139, 40, 132]),
    grid_generator(9, 3, [9, 61, 10, 9, 61, 10, 9, 61, 10, 9, 61, 10, 9, 61, 10, 9, 61, 10, 9, 61, 10, 9, 61, 10, 9, 61, 10],1.5),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(200)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(166)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(101), 1.5),
    grid_generator(9, 3, [100, 135, 99, 100, 135, 99, 100, 135, 99, 100, 135, 99, 100, 135, 99, 100, 135, 99, 100, 135, 99, 100, 135, 99, 100, 135, 99]),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(165)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(128)), 
    grid_generator(9, 3, [28, 327, 48, 28, 327, 48, 28, 327, 48, 28, 327, 48, 28, 327, 48, 28, 327, 48, 28, 327, 48, 28, 327, 48, 28, 327, 48]),
    grid_generator(9, 4, [18, 22, 140, 88, 18, 22, 140, 88, 18, 22, 140, 88, 18, 22, 140, 88, 18, 22, 140, 88, 18, 22, 140, 88, 18, 22, 140, 88, 18, 22, 140, 88, 18, 22, 140, 88]),
    grid_generator(9, 4, [216, 16, 122, 36, 216, 16, 122, 36, 216, 16, 122, 36, 216, 16, 122, 36, 216, 16, 122, 36, 216, 16, 122, 36, 216, 16, 122, 36, 216, 16, 122, 36, 216, 16, 122, 36], 1.5)
]; 

// lista para las dimensiones en y 
var y_size_list = [
    grid_generator(1, 4, [...Array(1*4).keys()].fill(72),3),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(997),200/379),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(348),1),
    grid_generator(4, 1, [...Array(1*4).keys()].fill(83),1.5),
    grid_generator(9, 3, [27, 27, 27, 65, 65, 65, 18, 18, 18, 62, 62, 62, 20, 20, 20, 61, 61, 61, 15, 15, 15, 63, 63, 63, 54, 54, 54]),
    grid_generator(9, 3, [44, 44, 44, 23, 23, 23, 10, 10, 10, 21, 21, 21, 14, 14, 14, 21, 21, 21, 13, 13, 13, 22, 22, 22, 40, 40, 40],1.5),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(200)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(341)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(146), 1.5),
    grid_generator(9, 3, [18, 18, 18, 76, 76, 76, 12, 12, 12, 76, 76, 76, 12, 12, 12, 76, 76, 76, 11, 11, 11, 76, 76, 76, 22, 22, 22]),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(231)),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(199)),
    grid_generator(9, 3, [54, 54, 54, 38, 38, 38, 17, 17, 17, 38, 38, 38, 16, 16, 16, 38, 38, 38, 17, 17, 17, 38, 38, 38, 54, 54, 54]),
    grid_generator(9, 4, [112, 112, 112, 112, 34, 34, 34, 34, 22, 22, 22, 22, 34, 34, 34, 34, 21, 21, 21, 21, 34, 34, 34, 34, 21, 21, 21, 21, 34, 34, 34, 34, 33, 33, 33, 33]),
    grid_generator(9, 4, [118, 118, 118, 118, 40, 40, 40, 40, 9, 9, 9, 9, 40, 40, 40, 40, 8, 8, 8, 8, 40, 40, 40, 40, 8, 8, 8, 8, 40, 40, 40, 40, 62, 62, 62, 62], 1.5)
]; 

// lista para el texto de cada juego  
var pregunta_list = [
    '<p style="font-size:120%;">Tienes que elegir una sola de estas cajitas<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál eliges?<br></p>',
    '<p style="font-size:120%;">Un amigo te pide comprar una Pepsi. En el supermercado sólo quedan 4 botellas<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál llevas?<br><br></p>',
    '<p style="font-size:120%;">Pasas a buscar a un amigo para que salgan al cine. Cuando llegas a su casa, tu amigo no está listo todavía, te pide que le esperes un ratito en la sala de estar.<br></p><p style="font-weight: bold;font-size:120%;">¿En cuál de estas sillas te sientas para esperar?<br><br></p>',
    '<p style="font-size:120%;">Tienes que elegir uno de estos círculos.<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál eliges?<br><br></p>',
    '<p style="font-size:120%;">Tu tío te encarga comprar una Coca Cola. En el supermercado, el único estante con esta bebida es el que aparece en la foto<br></p><p style="font-weight: bold;font-size:120%;">¿De dónde sacas una lata?<br><br></p>',
    '<p style="font-size:120%;">Tu celular ya no tiene batería, necesitas enchufarlo a la corriente lo antes posible<br></p><p style="font-weight: bold;font-size:120%;">¿En cuál de estos enchufes lo conectas?<br><br></p>', 
    '<p style="font-size:120%;">En una sala de juegos, te dan el desafío de encontrar un tesoro escondido en una de estas cajas fuertes<br></p><p style="font-weight: bold;font-size:120%;">¿En cuál caja buscas el tesoro?<br><br></p>',
    '<p style="font-size:120%;">Estás en un laberinto. Una sola puerta permite de salir, y tienes sólo un intento para encontrar la salida.<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál de estas puertas eliges abrir?<br><br></p>',  
    '<p style="font-size:120%;">En un juego callejero, un hombre coloca una bolita bajo uno de estos vasos y luego los cambia de posición rápidamente. Te pide que le indiques bajo qué vaso se encuentra la bolita.<br></p><p style="font-weight: bold;font-size:120%;">¿Bajo cuál vaso crees que está la bolita?<br><br></p>',
    '<p style="font-size:120%;">Un equipo de trabajo está entrando a una sala de reunión. Son 8 trabajadores y hay 8 sillas<br></p><p style="font-weight: bold;font-size:120%;">¿En qué silla crees que se sentará el trabajador con mayor años de antigüedad en el equipo?<br><br></p>',
    '<p style="font-size:120%;">Imagina que trabajas en selección de personal. Tienes que seleccionar 1 de los 4 candidatos que están sentados en las sillas que se muestran a continuación<br></p><p style="font-weight: bold; font-size:120%;">¿En qué silla piensas que el mejor candidato está sentado?<br><br></p>',
    '<p style="font-size:120%;">Vas a la farmacia a comprar vitaminas. Te presentan estos  productos multivitamínicos que son nuevos en el mercado<br></p><p style="font-weight: bold;font-size:120%;">¿cuál eliges?<br><br></p>',
    '<p style="font-size:120%;">Hay elecciones presidenciales en Ucrania <br></p><p style="font-weight: bold;font-size:120%;">¿Por cuál de estos candidatos votarías tú?<br><br></p>',
    '<p style="font-size:120%;">Si ganaras un viaje a Estados Unidos,<br></p><p style="font-weight: bold;font-size:120%;">¿en cuál de estos hoteles alojarías?<br><br></p>',
    '<p style="font-size:120%;">Te invitan a un restaurante finés<br></p><p style="font-weight: bold;font-size:120%;">¿Cuál de estos platos típicos eliges para probar?<br><br></p>'  
]; 

// lista de imágenes  
var pref_1 = "Imagenes_juegos/imagen_juego_";
var pref_2 = "/imagen_juego_";
var pref = [pref_1+"1"+pref_2+"1_", pref_1+"2"+pref_2+"2_", pref_1+"3"+pref_2+"3_", pref_1+"4"+pref_2+"4_",pref_1+"5"+pref_2+"5_",pref_1+"6"+pref_2+"6_",pref_1+"7"+pref_2+"7_",pref_1+"8"+pref_2+"8_",pref_1+"9"+pref_2+"9_",pref_1+"10"+pref_2+"10_",pref_1+"11"+pref_2+"11_",pref_1+"12"+pref_2+"12_",pref_1+"13"+pref_2+"13_",pref_1+"14"+pref_2+"14_",pref_1+"15"+pref_2+"15_"]

var imagenes_list = [
    grid_generator(1, 4, [...Array(1*4).keys()].fill(pref[0] + "1.jpg")),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(pref[1] + "1.jpg")),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(pref[2] + "1.jpg")),
    grid_generator(4, 1, [...Array(1*4).keys()].fill(pref[3] + "1.jpg")),
    grid_generator(9, 3, [pref[4]+"1.png",pref[4]+"2.png",pref[4]+"3.png",pref[4]+"4.png",pref[4]+"5.png",pref[4]+"6.png",pref[4]+"7.png",pref[4]+"8.png",pref[4]+"9.png",pref[4]+"10.png",pref[4]+"11.png",pref[4]+"12.png",pref[4]+"13.png",pref[4]+"14.png",pref[4]+"15.png",pref[4]+"16.png",pref[4]+"17.png",pref[4]+"18.png",pref[4]+"19.png",pref[4]+"20.png",pref[4]+"21.png",pref[4]+"22.png",pref[4]+"23.png",pref[4]+"24.png",pref[4]+"25.png",pref[4]+"26.png",pref[4]+"27.png"]),
    grid_generator(9, 3, [pref[5]+"1.png",pref[5]+"2.png",pref[5]+"3.png",pref[5]+"4.png",pref[5]+"5.png",pref[5]+"6.png",pref[5]+"7.png",pref[5]+"8.png",pref[5]+"9.png",pref[5]+"10.png",pref[5]+"11.png",pref[5]+"12.png",pref[5]+"13.png",pref[5]+"14.png",pref[5]+"15.png",pref[5]+"16.png",pref[5]+"17.png",pref[5]+"18.png",pref[5]+"19.png",pref[5]+"20.png",pref[5]+"21.png",pref[5]+"22.png",pref[5]+"23.png",pref[5]+"24.png",pref[5]+"25.png",pref[5]+"26.png",pref[5]+"27.png"]),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(pref[6] + "1.jpg")),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(pref[7] + "1.jpg")),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(pref[8] + "1.jpg")),
    grid_generator(9, 3, [pref[9]+"1.png",pref[9]+"2.png",pref[9]+"3.png",pref[9]+"4.png",pref[9]+"5.png",pref[9]+"6.png",pref[9]+"7.png",pref[9]+"8.png",pref[9]+"9.png",pref[9]+"10.png",pref[9]+"11.png",pref[9]+"12.png",pref[9]+"13.png",pref[9]+"14.png",pref[9]+"15.png",pref[9]+"16.png",pref[9]+"17.png",pref[9]+"18.png",pref[9]+"19.png",pref[9]+"20.png",pref[9]+"21.png",pref[9]+"22.png",pref[9]+"23.png",pref[9]+"24.png",pref[9]+"25.png",pref[9]+"26.png",pref[9]+"27.png"]),
    grid_generator(1, 4, [...Array(1*4).keys()].fill(pref[10] + "1.jpg"))
]; 
var imagenes_list_11 = [];
var imagenes_list_12 = [];
var imagenes_list_13 = [];
var imagenes_list_14 = [];
var data_11 = [pref[11]+"1.png",pref[11]+"2.png",pref[11]+"3.png",pref[11]+"4.png"];
var data_12 = [pref[12]+"1.png",pref[12]+"2.png",pref[12]+"3.png",pref[12]+"4.png",pref[12]+"5.png",pref[12]+"6.png",pref[12]+"7.png",pref[12]+"8.png",pref[12]+"9.png",pref[12]+"10.png",pref[12]+"11.png",pref[12]+"12.png",pref[12]+"13.png",pref[12]+"14.png",pref[12]+"15.png",pref[12]+"16.png",pref[12]+"17.png",pref[12]+"18.png",pref[12]+"19.png",pref[12]+"20.png",pref[12]+"21.png",pref[12]+"22.png",pref[12]+"23.png",pref[12]+"24.png",pref[12]+"25.png",pref[12]+"26.png",pref[12]+"27.png"];
var data_13 = [pref[13]+"1.png",pref[13]+"2.png",pref[13]+"3.png",pref[13]+"4.png",pref[13]+"5.png",pref[13]+"6.png",pref[13]+"7.png",pref[13]+"8.png",pref[13]+"9.png",pref[13]+"10.png",pref[13]+"11.png",pref[13]+"12.png",pref[13]+"13.png",pref[13]+"14.png",pref[13]+"15.png",pref[13]+"16.png",pref[13]+"17.png",pref[13]+"18.png",pref[13]+"19.png",pref[13]+"20.png",pref[13]+"21.png",pref[13]+"22.png",pref[13]+"23.png",pref[13]+"24.png",pref[13]+"25.png",pref[13]+"26.png",pref[13]+"27.png",pref[13]+"28.png",pref[13]+"29.png",pref[13]+"30.png",pref[13]+"31.png",pref[13]+"32.png",pref[13]+"33.png",pref[13]+"34.png",pref[13]+"35.png",pref[13]+"36.png"];
var data_14 = [pref[14]+"1.png",pref[14]+"2.png",pref[14]+"3.png",pref[14]+"4.png",pref[14]+"5.png",pref[14]+"6.png",pref[14]+"7.png",pref[14]+"8.png",pref[14]+"9.png",pref[14]+"10.png",pref[14]+"11.png",pref[14]+"12.png",pref[14]+"13.png",pref[14]+"14.png",pref[14]+"15.png",pref[14]+"16.png",pref[14]+"17.png",pref[14]+"18.png",pref[14]+"19.png",pref[14]+"20.png",pref[14]+"21.png",pref[14]+"22.png",pref[14]+"23.png",pref[14]+"24.png",pref[14]+"25.png",pref[14]+"26.png",pref[14]+"27.png",pref[14]+"28.png",pref[14]+"29.png",pref[14]+"30.png",pref[14]+"31.png",pref[14]+"32.png",pref[14]+"33.png",pref[14]+"34.png",pref[14]+"35.png",pref[14]+"36.png"];

for (condicion = 1; condicion < 25; condicion++) {
    // Agregar lista de imagenes a la lista 
    imagenes_list_11.push(grid_generator(1, 4, data_11, 0, [11,condicion]));
    imagenes_list_12.push(grid_generator(9, 3, data_12, 0, [12,condicion]));
    imagenes_list_13.push(grid_generator(9, 4, data_13, 0, [13,condicion]));
    imagenes_list_14.push(grid_generator(9, 4, data_14, 0, [14,condicion]));    
};
imagenes_list.push(imagenes_list_11);
imagenes_list.push(imagenes_list_12);
imagenes_list.push(imagenes_list_13);
imagenes_list.push(imagenes_list_14);

var border_list = [10, 10, 10, 10, 0, 0, 10, 10, 40, 0, 15, 20, 0, 0, 0]; 

// funcion que entrega los arrays para los casos simples
function juego_simple(i, cond) {
    console.log('juego_simple')
    var data_juego = {
        type: 'serial-reaction-time-mouse', 
        allow_nontarget_responses: true,
        grid: grid_list[i],
        grid_allowed: grid_allowed_list[i],
        target: [0,0], 
        prompt: pregunta_list[i],
        border_spacing: border_list[i],
        grid_square_size_x: x_size_list[i],
        grid_square_size_y: y_size_list[i]
    }    
    if (i == 11 || i == 12 || i == 13 || i == 14){
        data_juego.grid_images = imagenes_list[i][cond-1];
    } else {
        data_juego.grid_images = imagenes_list[i];
    }
    console.log(data_juego);  
    return data_juego
};


// funcion general que entrega cada uno de los juegos
function juego_data_condition(i, cond = 0) {
    if (i == 1){
        var result = juego_simple(0); 
    } else if (i == 2){
        var result = juego_simple(1);
    } else if (i == 3){
        var result = juego_simple(2);
    } else if (i == 4){
        var result = juego_simple(3);
    } else if (i == 5){
        var result = juego_simple(4);
    } else if (i == 6){
        var result = juego_simple(5);
    } else if (i == 7){
        var result = juego_simple(6);
    } else if (i == 8){
        var result = juego_simple(7);
    } else if (i == 9){
        var result = juego_simple(8);
    } else if (i == 10){
        var result = juego_simple(9);
    } else if (i == 11){
        var result = juego_simple(10);
    } else if (i == 12){
        var result = juego_simple(11, cond);
    } else if (i == 13){
        var result = juego_simple(12, cond);
    } else if (i == 14){
        var result = juego_simple(13, cond);
    } else if (i == 15){
        var result = juego_simple(14, cond);
    }
    result.data = {juego: i};
    return result 
}


function data_todas_imagenes(){
    var todas_imagenes = ["imagen_juego_interferencia.jpg"];
    
    todas_imagenes = todas_imagenes.concat([pref[0] + "1.jpg"]);
    todas_imagenes = todas_imagenes.concat([pref[1] + "1.jpg"]);
    todas_imagenes = todas_imagenes.concat([pref[2] + "1.jpg"]);
    todas_imagenes = todas_imagenes.concat([pref[3] + "1.jpg"]);
    todas_imagenes = todas_imagenes.concat([pref[4]+"1.png",pref[4]+"2.png",pref[4]+"3.png",pref[4]+"4.png",pref[4]+"5.png",pref[4]+"6.png",pref[4]+"7.png",pref[4]+"8.png",pref[4]+"9.png",pref[4]+"10.png",pref[4]+"11.png",pref[4]+"12.png",pref[4]+"13.png",pref[4]+"14.png",pref[4]+"15.png",pref[4]+"16.png",pref[4]+"17.png",pref[4]+"18.png",pref[4]+"19.png",pref[4]+"20.png",pref[4]+"21.png",pref[4]+"22.png",pref[4]+"23.png",pref[4]+"24.png",pref[4]+"25.png",pref[4]+"26.png",pref[4]+"27.png"]);
    todas_imagenes = todas_imagenes.concat([pref[5]+"1.png",pref[5]+"2.png",pref[5]+"3.png",pref[5]+"4.png",pref[5]+"5.png",pref[5]+"6.png",pref[5]+"7.png",pref[5]+"8.png",pref[5]+"9.png",pref[5]+"10.png",pref[5]+"11.png",pref[5]+"12.png",pref[5]+"13.png",pref[5]+"14.png",pref[5]+"15.png",pref[5]+"16.png",pref[5]+"17.png",pref[5]+"18.png",pref[5]+"19.png",pref[5]+"20.png",pref[5]+"21.png",pref[5]+"22.png",pref[5]+"23.png",pref[5]+"24.png",pref[5]+"25.png",pref[5]+"26.png",pref[5]+"27.png"]);
    todas_imagenes = todas_imagenes.concat([pref[6] + "1.jpg"]);
    todas_imagenes = todas_imagenes.concat([pref[7] + "1.jpg"]);
    todas_imagenes = todas_imagenes.concat([pref[8] + "1.jpg"]);
    todas_imagenes = todas_imagenes.concat([pref[9]+"1.png",pref[9]+"2.png",pref[9]+"3.png",pref[9]+"4.png",pref[9]+"5.png",pref[9]+"6.png",pref[9]+"7.png",pref[9]+"8.png",pref[9]+"9.png",pref[9]+"10.png",pref[9]+"11.png",pref[9]+"12.png",pref[9]+"13.png",pref[9]+"14.png",pref[9]+"15.png",pref[9]+"16.png",pref[9]+"17.png",pref[9]+"18.png",pref[9]+"19.png",pref[9]+"20.png",pref[9]+"21.png",pref[9]+"22.png",pref[9]+"23.png",pref[9]+"24.png",pref[9]+"25.png",pref[9]+"26.png",pref[9]+"27.png"]);
    todas_imagenes = todas_imagenes.concat([pref[10] + "1.jpg"]);
    todas_imagenes = todas_imagenes.concat(data_11); 
    todas_imagenes = todas_imagenes.concat(data_12); 
    todas_imagenes = todas_imagenes.concat(data_13); 
    todas_imagenes = todas_imagenes.concat(data_14); 

    return todas_imagenes
};

