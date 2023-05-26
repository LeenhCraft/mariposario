import sys
import os
import json
import torchvision.transforms as transforms
import joblib
import numpy as np
from torchvision.models import alexnet
from sklearn.svm import SVC
from PIL import Image
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report
from datetime import datetime

nombre_modelo = sys.argv[1]
ruta_modelo = sys.argv[2]
label_entrenamiento = sys.argv[3]
datos_de_entrenamiento = sys.argv[4]

# Cargar el modelo pre-entrenado de AlexNet
model = alexnet(pretrained=True)
# Obtener la salida de la primera capa totalmente conectada (4096-dimensional)
first_fc_output = model.classifier[1].in_features

# Cargar los datos de entrenamiento de las características de mariposas previamente extraídas
# y sus etiquetas correspondientes
train_features = np.load(datos_de_entrenamiento)
train_labels = np.load(label_entrenamiento)

# Asegurarse de que train_features tenga una dimensión adecuada
train_features = np.reshape(train_features, (train_features.shape[0], -1))

# Ajustar el clasificador SVM a los datos de entrenamiento
classifier = SVC(kernel='linear')
# classifier.fit(train_features, train_labels)

# Dividir los datos en conjuntos de entrenamiento y prueba
X_train, X_test, y_train, y_test = train_test_split(train_features, train_labels, test_size=0.2, random_state=42)

# Ajustar el clasificador SVM a los datos de entrenamiento
classifier.fit(X_train, y_train)

# Predecir las etiquetas de los datos de prueba
y_pred = classifier.predict(X_test)

# Verificar que exista el directorio
if not os.path.exists(ruta_modelo):
    os.makedirs(ruta_modelo)

# Obtener la fecha y hora actual
now = datetime.now()
timestamp = now.strftime("%Y%m%d%H%M%S")
nuevo_nombre=f"mdl-{nombre_modelo}_{timestamp}"
# Guardar el clasificador entrenado
joblib.dump(classifier, os.path.join(ruta_modelo, f"{nuevo_nombre}.pkl"))  

# Imprimir el informe de clasificación (precisión, recall, f1-score, etc.)
reporte = classification_report(y_test, y_pred)

# compronar si existe el archivo
archivo_guardado = os.path.join(ruta_modelo, f"{nuevo_nombre}.pkl")
if os.path.exists(archivo_guardado):
    # Objeto JSON a imprimir
    data = {
        "status": True,
        "message": "El archivo se guardó correctamente.",
        "name":nuevo_nombre+".pkl",
        "pkl":ruta_modelo+"/"+nuevo_nombre+".pkl",
        "reporte":reporte
    }

    # Convertir el objeto en una cadena JSON
    json_data = json.dumps(data)
    print(json_data)
else:
    data = {
        "status": False,
        "message": "El archivo no se guardó correctamente.",
        "name":"",
        "pkl":"",
        "reporte":""
    }
    # Convertir el objeto en una cadena JSON
    json_data = json.dumps(data)
    print(json_data)   