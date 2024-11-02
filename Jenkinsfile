pipeline {
    agent any
    triggers {
        // Activa el pipeline cuando se detecta un nuevo commit en el repositorio
        githubPush()
    }
    stages {
        stage('Checkout') {
            steps {
                // Clona el repositorio
                git url: 'https://github.com/MiguelRosalesL/PaginaSandra', branch: 'main'
            }
        }
        stage('Check for PHP Files') {
            steps {
                script {
                    // Verificar si hay archivos .php en el commit
                    def phpFiles = sh(
                        script: "git diff --name-only HEAD~1 | grep '\\.php$' || true", 
                        returnStdout: true
                    ).trim()
                    
                    if (phpFiles) {
                        error("Commit contiene archivos .php, lo cual no está permitido:\n${phpFiles}")
                    } else {
                        echo 'No PHP files detected, proceeding with the pipeline.'
                    }
                }
            }
        }
        stage('Build') {
            steps {
                echo 'Building...'
                // Agrega aquí tus comandos de construcción
                // Ejemplo: sh 'mvn clean install'
            }
        }
        stage('Test') {
            steps {
                echo 'Running tests...'
                // Agrega aquí tus comandos de prueba
                // Ejemplo: sh 'mvn test'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying...'
                // Agrega comandos de despliegue si los tienes
            }
        }
    }
    post {
        success {
            echo 'Pipeline completed successfully!'
        }
        failure {
            echo 'Pipeline failed.'
        }
    }
}
