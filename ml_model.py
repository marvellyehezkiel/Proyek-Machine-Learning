import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import accuracy_score
from sklearn.preprocessing import StandardScaler
import joblib

# Load data
data = pd.read_csv('data_jurusan.csv')

# Pisahkan fitur dan target
X = data[['matematika', 'bahasa_indonesia', 'bahasa_inggris', 'fisika']]
y = data['jurusan']

# Lakukan standar skala pada data fitur
scaler = StandardScaler()
X_scaled = scaler.fit_transform(X)

# Bagi data menjadi data latih dan data uji
X_train, X_test, y_train, y_test = train_test_split(X_scaled, y, test_size=0.3, random_state=42)

# Latih model
model = LogisticRegression(max_iter=200)
model.fit(X_train, y_train)

# Evaluasi model
y_pred = model.predict(X_test)
accuracy = accuracy_score(y_test, y_pred)
print(f"Akurasi model: {accuracy * 100}%")

# Simpan model
joblib.dump(model, 'model_jurusan.pkl')
