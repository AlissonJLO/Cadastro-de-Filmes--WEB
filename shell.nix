# shell.nix
{ pkgs ? import <nixpkgs> { config.allowUnfree = true; }
}:

pkgs.mkShell {
  name="AP1-Filmes-environment";

  # Pacotes necessários para o ambiente
  buildInputs = [
    # Core do projeto
    pkgs.php             # PHP 8.2 (versão moderna)
    pkgs.phpPackages.composer # Gerenciador de dependências PHP (boa prática)

    # Utilitários de desenvolvimento
    pkgs.git               # Comandos básicos de git
    pkgs.gitflow           # Comandos com suporte ao git flow
    pkgs.micro             # Editor de texto de terminal
    pkgs.bat               # Similar ao cat mas com formatação visual
    pkgs.docker             # Docker
    pkgs.docker-compose     # Docker Compose
    pkgs.vscode            # IDE Visual Studio Code
  ];

  # Comandos a serem executados quando o shell é iniciado
  shellHook = ''
    echo ""
    echo "Instalando extensões recomendadas do VS Code..."
    # Extensões para desenvolvimento PHP, SQL e geral
    code --install-extension bmewburn.vscode-intelephense-client --force # Intellisense para PHP
    code --install-extension DEVSENSE.phptools-vscode --force           # Ferramentas PHP
    code --install-extension mtxr.sqltools --force                      # Cliente SQL universal
    code --install-extension mtxr.sqltools-driver-pg --force            # Driver do PostgreSQL para SQLTools
    code --install-extension PKief.material-icon-theme --force
    code --install-extension dbaeumer.vscode-eslint --force
    code --install-extension streetsidesoftware.code-spell-checker --force
    code --install-extension streetsidesoftware.code-spell-checker-portuguese-brazilian --force
    code --install-extension formulahendry.auto-close-tag --force
    code --install-extension christian-kohler.path-intellisense --force
    code --install-extension aaron-bond.better-comments --force
    code --install-extension ms-azuretools.vscode-docker --force

    echo ""
    echo "Ambiente de Desenvolvimento de Filmes pronto!"
    echo "Para rodar o servidor PHP local, use: php -S localhost:8000"
    echo "Para acessar o banco, use: psql"
    echo "Caso não possua um editor de código, execute o comando: code ."
  '';
}
