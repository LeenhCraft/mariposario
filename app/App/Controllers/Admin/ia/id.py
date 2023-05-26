
import json
import sys
import torch
import torchvision.transforms as transforms
import joblib
from torchvision.models import alexnet
from sklearn.svm import SVC
from PIL import Image
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report

# print("Directorio del archivo actual:", os.path.dirname(__file__))
ruta_imagen = sys.argv[1]
ruta_modelo = sys.argv[2]

# Cargar el modelo pre-entrenado de AlexNet
model = alexnet(pretrained=True)
# Obtener la salida de la primera capa totalmente conectada (4096-dimensional)
first_fc_output = model.classifier[1].in_features

# Crear un transformador para preprocesar la imagen
transform = transforms.Compose([
    transforms.Resize(256),
    transforms.CenterCrop(224),
    transforms.ToTensor(),
    transforms.Normalize(mean=[0.485, 0.456, 0.406], std=[0.229, 0.224, 0.225])
])

# Cargar la imagen de la mariposa y aplicar transformaciones
# image_path = os.path.dirname(__file__)+"/img_prueba.jpg"  # Reemplaza con la ruta de tu imagen
image_path = ruta_imagen  # Reemplaza con la ruta de tu imagen
image = Image.open(image_path)
image = image.convert("RGB")
image = transform(image).unsqueeze(0)

# Obtener las características de la imagen utilizando AlexNet
features = model.features(image)
features = torch.flatten(features, 1)
features = features.detach().numpy()

# Cargar el clasificador SVM previamente entrenado o entrenarlo si no existe
try:
    # classifier = joblib.load(os.path.dirname(__file__)+"/svm_model.pkl")
    classifier = joblib.load(ruta_modelo)
except FileNotFoundError:
    dataa = {
        "status": True,
        "message": "El modelo no ha sido entrenado, por favor intente más tarde."
    }   

    # Convertir el objeto en una cadena JSON
    json_data = json.dumps(dataa)
    print(json_data)


# Clasificar la imagen de la mariposa utilizando el clasificador SVM
prediction = classifier.predict(features[:, :first_fc_output])

# Imprimir la etiqueta de clasificación predicha

print(prediction)
# dataa = {
#     "status": True,
#     "message": prediction
# }
# json_data = json.dumps(dataa)
# print(json_data)