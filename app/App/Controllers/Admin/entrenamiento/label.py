import json
import sys
import os
import numpy as np
import ast
from datetime import datetime

path_entrenamiento = sys.argv[1]
nombre_archivo = sys.argv[2]
txt = sys.argv[3]

# print(json.dumps(sys.argv[3]))
# print(sys.argv[3])
# exit()

# Leer el contenido del archivo de texto
with open(txt, "r") as archivo:
    contenido = archivo.read()

# Convertir el contenido en una lista de pares clave-valor
data = ast.literal_eval(contenido)
# print(data)
# exit()
# Generar el array con las repeticiones
result = []
for item in data:
    cantidad, palabra = item.split('=')
    cantidad = int(cantidad.strip())
    palabra = palabra.strip().replace('"', '')
    result.extend([palabra] * cantidad)

# Crea un diccionario para asignar un número único a cada especie
species_dict = {species: i for i, species in enumerate(set(result))}
# print(species_dict)
# exit()
# Crea una lista de etiquetas utilizando el diccionario de especies
train_labels = [species_dict[species] for species in result]

# Imprime el diccionario de especies
diccionario = json.dumps(species_dict)
# print(diccionario)

# Verificar que exista el directorio
if not os.path.exists(path_entrenamiento):
    os.makedirs(path_entrenamiento) 

# Obtener la fecha y hora actual
now = datetime.now()
timestamp = now.strftime("%Y%m%d%H%M%S")

# Concatenar la fecha y hora actual al nombre de los datos de entrenamiento
nombre_datos_entrenamiento = f"label-{nombre_archivo}-{timestamp}"

# Guarda el array NumPy en un archivo 'etiquetas_de_entrenamiento.npy'
np.save(os.path.join(path_entrenamiento, f"{nombre_datos_entrenamiento}.npy"), train_labels)

# compronar si existe el archivo
archivo_guardado = os.path.join(path_entrenamiento, f"{nombre_datos_entrenamiento}.npy")
if os.path.exists(archivo_guardado):
    # Objeto JSON a imprimir
    data = {
        "status": True,
        "message": "El archivo se guardó correctamente.",
        "name":nombre_datos_entrenamiento+".npy",
        "npy":os.path.join(path_entrenamiento, f"{nombre_datos_entrenamiento}.npy"),
        "dicc":diccionario
    }

    # Convertir el objeto en una cadena JSON
    json_data = json.dumps(data)
    print(json_data)
else:
    data = {
        "status": False,
        "message": "El archivo no se guardó correctamente.",
        "name":"",
        "npy":"",
        "dicc":""
    }
    # Convertir el objeto en una cadena JSON
    json_data = json.dumps(data)
    print(json_data)
