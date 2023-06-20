import sys
import os
import subprocess
import json

nombre_modelo = sys.argv[1]
ruta_modelo = sys.argv[2]
label_entrenamiento = sys.argv[3]
datos_de_entrenamiento = sys.argv[4]

# Ruta del archivo Python
archivo_python = os.path.dirname(__file__)+"/entrenar.py "+nombre_modelo+' '+ruta_modelo+' '+label_entrenamiento+' '+datos_de_entrenamiento

# Comando a ejecutar
comando = f"python {archivo_python}"

try:
    # Ejecutar el comando y capturar la salida
    salida = subprocess.check_output(comando, shell=True, stderr=subprocess.STDOUT, universal_newlines=True)
    
    # La ejecución fue exitosa
    # print("Ejecución exitosa. Salida:")
    print(salida)
except subprocess.CalledProcessError as e:
    # Ocurrió un error al ejecutar el comando
    # print("Ocurrió un error al ejecutar el comando:")
    # print("Código de salida:", e.returncode)
    # print("Error:", e.output)
    # leenh
    data = {
        "status": False,
        "message": "Ocurrió un error al ejecutar el comando.",
        "name":"",
        "pkl":"",
        "reporte":""
    }
    # Convertir el objeto en una cadena JSON
    json_data = json.dumps(data)
    print(json_data)

# metodo 2

# # Ruta del archivo Python
# archivo_python = os.path.dirname(__file__) + "/label.py"

# # Pasar los valores al archivo Python utilizando subprocess
# resultado = subprocess.run(["python", archivo_python, path_entrenamiento, nombre_entrenamiento, txt])
# # Imprimir la salida como JSON
# # print(json.dumps(resultado.decode('utf-8')))
# print(resultado.decode('utf-8'))

# # # Verificar si ocurrió algún error
# # if resultado.returncode != 0:
# #     # Error durante la ejecución
# #     error = resultado.stderr.decode('utf-8')
# #     print("Ocurrió un error:", error)
# # else:
# #     # Obtener la salida
# #     salida = resultado.stdout.decode('utf-8')
# #     print("Salida:", salida)