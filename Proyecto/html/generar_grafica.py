from flask import Flask, send_file
import mysql.connector
import pandas as pd
import matplotlib.pyplot as plt
import io

app = Flask(__name__)

@app.route('/grafica')
def grafica():
    # Configuración de la base de datos
    db_config = {
        'host': 'localhost',
        'user': 'root',  # Por defecto en XAMPP
        'password': '',
        'database': 'erp'
    }

    # Conectar a la base de datos
    conn = mysql.connector.connect(**db_config)

    # Consulta SQL
    query = "SELECT nombre_item, SUM(cantidad) AS total_cantidad FROM elementos GROUP BY nombre_item;"

    # Leer los datos en un DataFrame de pandas
    df = pd.read_sql(query, conn)

    # Cerrar la conexión
    conn.close()

    # Configurar el gráfico
    plt.figure(figsize=(10, 6))
    plt.bar(df['nombre_item'], df['total_cantidad'], color='skyblue')

    # Añadir títulos y etiquetas
    plt.title('Total de Productos Vendidos por Cantidad')
    plt.xlabel('Nombre del Item')
    plt.ylabel('total_cantidad')
    plt.xticks(rotation=45)  # Rotar etiquetas del eje x para mejor visibilidad

    # Guardar el gráfico en un buffer de memoria
    buf = io.BytesIO()
    plt.tight_layout()  # Ajustar el diseño para evitar recortes
    plt.savefig(buf, format='png')
    buf.seek(0)

    # Mostrar el gráfico en el navegador
    return send_file(buf, mimetype='image/png')

if __name__ == '__main__':
    app.run(debug=True)
