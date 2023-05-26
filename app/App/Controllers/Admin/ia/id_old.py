import os
import sys
import torch
import torchvision.transforms as transforms
import joblib
import numpy as np
from torchvision.models import alexnet
from sklearn.svm import SVC
from PIL import Image
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report

# print("Directorio del archivo actual:", os.path.dirname(__file__))

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
image_path = sys.argv[1]  # Reemplaza con la ruta de tu imagen
image = Image.open(image_path)
image = image.convert("RGB")
image = transform(image).unsqueeze(0)

# Obtener las características de la imagen utilizando AlexNet
features = model.features(image)
features = torch.flatten(features, 1)
features = features.detach().numpy()

# Cargar el clasificador SVM previamente entrenado o entrenarlo si no existe
try:
    classifier = joblib.load(os.path.dirname(__file__)+"/svm_model.pkl")  # Reemplaza con la ruta de tu clasificador entrenado
except FileNotFoundError:
    # Cargar los datos de entrenamiento de las características de mariposas previamente extraídas
    # y sus etiquetas correspondientes
    train_features = np.load(os.path.dirname(__file__)+"/datos_de_entrenamiento.npy")  # Reemplaza con la ruta de tus datos de entrenamiento
    train_labels = np.load(os.path.dirname(__file__)+"/etiquetas_de_entrenamiento.npy")  # Reemplaza con la ruta de tus etiquetas de entrenamiento

    # Asegurarse de que train_features tenga una dimensión adecuada
    train_features = np.reshape(train_features, (train_features.shape[0], -1))

    # Ajustar el clasificador SVM a los datos de entrenamiento
    classifier = SVC(kernel='linear')
    
    # Dividir los datos en conjuntos de entrenamiento y prueba
    X_train, X_test, y_train, y_test = train_test_split(train_features, train_labels, test_size=0.2, random_state=42)

    # Ajustar el clasificador SVM a los datos de entrenamiento
    classifier.fit(X_train, y_train)
    # classifier.fit(train_features, train_labels)

    # Predecir las etiquetas de los datos de prueba
    y_pred = classifier.predict(X_test)
    
    joblib.dump(classifier, os.path.dirname(__file__)+"/svm_model.pkl")  # Guardar el clasificador entrenado

    # Imprimir el informe de clasificación (precisión, recall, f1-score, etc.)
    print(classification_report(y_test, y_pred))
    
    # terminar el programa
    exit()


# Clasificar la imagen de la mariposa utilizando el clasificador SVM
prediction = classifier.predict(features[:, :first_fc_output])

# Imprimir la etiqueta de clasificación predicha
print("La imagen de la mariposa pertenece a la clase:", prediction)