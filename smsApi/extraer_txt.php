//---------------------------------------------------------------------------------------------
//-------------- EXTRAER EL TEXTO DE LOS ARHCIVOS PDF DE UNA CARPETA INDICADA
//-- Los archivos a procesar son todos aquellos que esten en esa carpeta
//-- 1- Al procesar cada archivo se genera un archivo con el mismo nombre pero tipo txt
//-- 2- Una ves terminada la conversion se copiaran ambos arhivos a la carpeta hija /convertidos
//-- 3- Se lee el archivos txt y se crea un reg.  Maestro en la tabla conversiones_mae
//-- 4. Se crean tantos reg. como lineas tenga el archivo en la tabla conversiones_det
//-- 5. Se ejecuta el procedimiento: ProcConveMae (Falta determinar cual es el correcto)
por cada linea en la tabla
Se borran ambos archivos de la carpeta actual.

- Traer todos los nombres de los archivos .pdf que esten en la carpeta raiz
$FolderOrigen ='';
$FolderDestino='';




pdftotext -layout  CM_1196262.pdf
