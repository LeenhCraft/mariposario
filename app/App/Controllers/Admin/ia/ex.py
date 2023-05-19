import sys
import os
import subprocess

# Ruta del archivo Python
archivo_python = os.path.dirname(__file__)+"/id.py "+sys.argv[1]

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
    print("Ocurrió un error al ejecutar el comando:")
    print("Código de salida:", e.returncode)
    print("Error:", e.output)
