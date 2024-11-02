pipeline {
    agent any

    triggers {
        // Este trigger se activa con los eventos de push desde GitHub
        githubPush() 
    }

    stages {
        stage('Check for File Types') {
            steps {
                script {
                    // Obtener la lista de archivos modificados
                    def modifiedFiles = sh(script: 'git diff --name-only HEAD~1', returnStdout: true).trim().split('\n')

                    // Variables para contar tipos de archivos
                    def phpFiles = []
                    def otherFiles = []

                    // Clasificar los archivos según su extensión
                    modifiedFiles.each { file ->
                        if (file.endsWith('.php')) {
                            phpFiles << file
                        } else {
                            otherFiles << file
                        }
                    }

                    // Mostrar resultados
                    if (phpFiles) {
                        echo "Detected PHP files: ${phpFiles.join(', ')}"
                    } else {
                        echo "No PHP files detected"
                    }

                    if (otherFiles) {
                        echo "Detected other files: ${otherFiles.join(', ')}"
                    } else {
                        echo "No other files detected"
                    }
                }
            }
        }
    }

    post {
        always {
            echo "Pipeline finished."
        }
    }
}
