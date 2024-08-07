from flask import Flask, send_file
import mysql.connector
import pandas as pd
import matplotlib.pyplot as plt
import io

app = Flask(__name__)

def generar_grafica_1():
    db_config = {
        'host': 'localhost',
        'user': 'root',
        'password': '',
        'database': 'erp'
    }
    conn = mysql.connector.connect(**db_config)
    query = "SELECT nombre_item, cantidad FROM elementos;"
    df = pd.read_sql(query, conn)
    conn.close()

    plt.figure(figsize=(10, 6))
    plt.bar(df['nombre_item'], df['cantidad'], color='skyblue')
    plt.title('Total de Pedidos Vendidos por Cantidad')
    plt.xlabel('Nombre del Item')
    plt.ylabel('Cantidad')
    plt.xticks(rotation=45)
    buf = io.BytesIO()
    plt.tight_layout()
    plt.savefig(buf, format='png')
    buf.seek(0)
    return buf

def generar_grafica_2():
    db_config = {
        'host': 'localhost',
        'user': 'root',
        'password': '',
        'database': 'erp'
    }
    conn = mysql.connector.connect(**db_config)
    query = "SELECT nombre_item, SUM(precio) as total_precio FROM elementos GROUP BY nombre_item;"
    df = pd.read_sql(query, conn)
    conn.close()

    plt.figure(figsize=(10, 6))
    plt.bar(df['nombre_item'], df['total_precio'], color='green')
    plt.title('Total de Ingresos por Item')
    plt.xlabel('Nombre del Item')
    plt.ylabel('Total Ingresos')
    plt.xticks(rotation=45)
    buf = io.BytesIO()
    plt.tight_layout()
    plt.savefig(buf, format='png')
    buf.seek(0)
    return buf

def generar_grafica_ventas_mes():
    db_config = {
        'host': 'localhost',
        'user': 'root',
        'password': '',
        'database': 'erp'
    }
    conn = mysql.connector.connect(**db_config)
    query = """
    SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes, COUNT(*) AS total_pedidos
    FROM pedidos
    GROUP BY DATE_FORMAT(fecha, '%Y-%m');
    """
    df = pd.read_sql(query, conn)
    conn.close()

    # Diccionario para mapear códigos de mes a nombres de mes
    meses = {
        '01': 'Enero', '02': 'Febrero', '03': 'Marzo', '04': 'Abril',
        '05': 'Mayo', '06': 'Junio', '07': 'Julio', '08': 'Agosto',
        '09': 'Septiembre', '10': 'Octubre', '11': 'Noviembre', '12': 'Diciembre'
    }

    # Convertir el formato 'YYYY-MM' a nombres de meses
    df['mes'] = df['mes'].apply(lambda x: f"{x[:4]} - {meses[x[5:]]}")

    plt.figure(figsize=(10, 10))
    plt.pie(df['total_pedidos'], labels=df['mes'], autopct='%1.1f%%', startangle=140)
    plt.title('Pedidos por Mes')
    buf = io.BytesIO()
    plt.tight_layout()
    plt.savefig(buf, format='png')
    buf.seek(0)
    return buf

@app.route('/grafica1')
def grafica1():
    buf = generar_grafica_1()
    return send_file(buf, mimetype='image/png')

@app.route('/grafica2')
def grafica2():
    buf = generar_grafica_2()
    return send_file(buf, mimetype='image/png')

@app.route('/grafica_ventas_mes')
def grafica_ventas_mes():
    buf = generar_grafica_ventas_mes()
    return send_file(buf, mimetype='image/png')

if __name__ == '__main__':
    app.run(debug=True)
