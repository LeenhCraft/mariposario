import sys
import os
import subprocess
import json

path_entrenamiento = sys.argv[1]
nombre_entrenamiento = sys.argv[2]
txt = sys.argv[3]

print(sys.argv[3])
exit()

# Ruta del archivo Python
archivo_python = os.path.dirname(__file__)+"/label.py "+path_entrenamiento+' '+nombre_entrenamiento+' '+txt

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

# Metodo 2

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