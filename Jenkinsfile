pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                git url: 'https://github.com/MiguelRosalesL/PaginaSandra', credentialsId: 'github-token'
            }
        }
        stage('Build') {
            steps {
                echo 'Building...'
                // Agrega aquí tus comandos de construcción, como "mvn clean install" o comandos específicos de tu proyecto
            }
        }
        stage('Test') {
            steps {
                echo 'Testing...'
                // Agrega aquí tus comandos de prueba, como "mvn test"
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying...'
                // Agrega comandos de despliegue si los tienes
            }
        }
    }
}
