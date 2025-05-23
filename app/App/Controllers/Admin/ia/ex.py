import sys
import os
import subprocess
import json

# Ruta del archivo Python
archivo_python = os.path.dirname(__file__)+"/id.py "+sys.argv[1]+" "+sys.argv[2]

# Comando a ejecutar
comando = rf"C:\Users\LEENH\anaconda3\envs\mariposario\python.exe {archivo_python}"

try:
    # Ejecutar el comando y capturar la salida
    salida = subprocess.check_output(comando, shell=True, stderr=subprocess.STDOUT, universal_newlines=True)
    
    # La ejecución fue exitosa
    # print("Ejecución exitosa. Salida:")
    print(salida)
except subprocess.CalledProcessError as e:
    
    # mostrar el error
    # print("Error al ejecutar el comando. Código de salida:", e.returncode)
    # print("Salida de error:", e.output)
    
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
