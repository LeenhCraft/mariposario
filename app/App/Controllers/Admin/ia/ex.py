import sys
import os
import subprocess
import json

# Ruta del archivo Python
archivo_python = os.path.dirname(__file__)+"/id.py "+sys.argv[1]+" "+sys.argv[2]

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
