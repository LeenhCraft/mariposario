import sys
import json
import os
import torch
import torchvision.transforms as transforms
import numpy as np
from torchvision.models import alexnet
from PIL import Image
from datetime import datetime

carpeta_img_entrenamiento = sys.argv[1]
path_entrenamiento = sys.argv[2]
nombre_archivo = sys.argv[3]

# Cargar el modelo pre-entrenado de AlexNet
model = alexnet(pretrained=True)

# Obtener la salida de la primera capa totalmente conectada (4096-dimensional)
first_fc_output = model.classifier[1].in_features

# Directorio que contiene las imágenes de entrenamiento
train_dir = carpeta_img_entrenamiento  # Reemplaza con la ruta de tu directorio de imágenes de entrenamiento

# Transformaciones para preprocesar las imágenes
transform = transforms.Compose([
    transforms.Resize(256),
    transforms.CenterCrop(224),
    transforms.ToTensor(),
    transforms.Normalize(mean=[0.485, 0.456, 0.406], std=[0.229, 0.224, 0.225])
])

# Lista para almacenar las características extraídas
train_features = []

# Iterar sobre las imágenes de entrenamiento y extraer características
# for filename in os.listdir(train_dir):
#     image_path = os.path.join(train_dir, filename)
#     image = Image.open(image_path).convert("RGB")
#     image = transform(image).unsqueeze(0)
    
#     # Obtener características de la imagen utilizando AlexNet
#     features = model.features(image)
#     features = torch.flatten(features, 1)
#     features = features.detach().numpy()
    
#     train_features.append(features)

for root, dirs, files in os.walk(train_dir):
    for filename in files:
        image_path = os.path.join(root, filename)
        image = Image.open(image_path).convert("RGB")
        image = transform(image).unsqueeze(0)
        
        # Obtener características de la imagen utilizando AlexNet
        features = model.features(image)
        features = torch.flatten(features, 1)
        features = features.detach().numpy()
        
        train_features.append(features)
        
# Convertir la lista de características en un array NumPy
train_features_array = np.array(train_features)

# Obtener la fecha y hora actual
now = datetime.now()
timestamp = now.strftime("%Y%m%d%H%M%S")

# Concatenar la fecha y hora actual al nombre de los datos de entrenamiento
nombre_datos_entrenamiento = f"img-{nombre_archivo}-{timestamp}"

# Guardar las características extraídas en un archivo 'datos_de_entrenamiento.npy'
np.save(os.path.join(path_entrenamiento, f"{nombre_datos_entrenamiento}.npy"),train_features_array)

# compronar si existe el archivo
archivo_guardado = os.path.join(path_entrenamiento, f"{nombre_datos_entrenamiento}.npy")
if os.path.exists(archivo_guardado):
    # Objeto JSON a imprimir
    data = {
        "status": True,
        "message": "El archivo se guardó correctamente.",
        "name":nombre_datos_entrenamiento+".npy",
        "npy":path_entrenamiento+"/"+nombre_datos_entrenamiento+".npy"
    }

    # Convertir el objeto en una cadena JSON
    json_data = json.dumps(data)
    print(json_data)
else:
    data = {
        "status": False,
        "message": "El archivo no se guardó correctamente.",
        "name":"",
        "npy":""
    }
    # Convertir el objeto en una cadena JSON
    json_data = json.dumps(data)
    print(json_data)   