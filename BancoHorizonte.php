<?php

class ContaBancaria {
    
    public float $numeroConta;
    public string $nome;
    public string $cpf;
    public string $nomeAgencia;
    public string $tipoConta;
    public float $saldo;
    public string $situacao;

    public function __construct { 
        $this->numeroConta = $numeroConta;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->nomeAgencia = $nomeAgencia;
        $this->tipoConta = $tipoConta;
        $this->saldo = 0.0;
        $this->situacao = $situacao;
    }

    public function exibirInformacoes(): void {
        echo "--- Banco Horizonte  ---\n";
        echo "Conta: {$this->numeroConta}\n";
        echo "Titular: {$this->nomeTitular}\n";
        echo "CPF: {$this->cpf}\n"; 
        echo "Agência: {$this->nomeAgencia}\n";
        echo "Tipo: {$this->tipoConta}\n";
        echo "Saldo: R$ {$this->saldo}\n";
        echo "Situação: {$this->situacao}\n";
    }

    public function depositar(float $saldo){
        if (!$this->ativo) {
            echo "Erro: Não é possível realizar depósitos numa conta bloqueada.\n";
            return false;
        }

        if ($valor <= 0) {
            echo "Erro: O valor do depósito deve ser maior que zero.\n";
            return false;
        }
 
        $this->saldo += $valor;
        
        echo "Depósito de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!\n";
        echo "Saldo atualizado para R$ " . number_format($this->saldo, 2, ',', '.') . ".\n";
        
        return true;
    }

    public function sacar(float $valor): bool {
        if (!$this->ativo) {
            echo "Saque recusado: Conta bloqueada.\n";
            return false;
        }

        if ($valor <= 0) {
            echo "Saque recusado: Valor inválido.\n";
            return false;
        }

        if ($valor > $this->saldo) {
            echo "Saque recusado: Saldo insuficiente.\n";
            return false;
        }

        $this->saldo -= $valor;
        echo "Saque realizado. Saldo atualizado: R$ " . number_format($this->saldo, 2, ',', '.') . "\n";
        return true;
    }

    public function consultarSaldo(): void {
        echo "Saldo atual: R$ " . number_format($this->saldo, 2, ',', '.') . "\n";
    }

    public function alterarTitular(string $novoNome): bool {
    if (trim($novoNome) === "") {
        echo "Alteração não realizada: O nome do titular não pode estar vazio.\n";
        return false;
    }

    $this->nomeTitular = trim($novoNome);
    echo "Nome do titular alterado com sucesso para: {$this->nomeTitular}\n";
    return true;
    }

    public function bloquearConta(): void {
    if (!$this->ativo) {
        echo "A conta já se encontra bloqueada.\n";
        return;
    }

    $this->ativo = false;
    echo "A conta foi bloqueada com sucesso.\n";
    }

    public function desbloquearConta(): void {
    if ($this->ativo) {
        echo "A conta já se encontra ativa.\n";
        return;
    }

    $this->ativo = true;
    echo "A conta foi desbloqueada com sucesso.\n";
    }

    public function transferir(float $valor, ContaBancaria $contaDestino): bool {
    if (!$this->ativo) {
        echo "Transferência recusada: A conta de origem está bloqueada.\n";
        return false;
    }

    if (!$contaDestino->ativo) {
        echo "Transferência recusada: A conta de destino está bloqueada.\n";
        return false;
    }

    if ($valor <= 0) {
        echo "Transferência recusada: O valor deve ser maior que zero.\n";
        return false;
    }

    if ($valor > $this->saldo) {
        echo "Transferência recusada: Saldo insuficiente na conta de origem.\n";
        return false;
    }

    $this->saldo -= $valor;
    $contaDestino->saldo += $valor;

    echo "Transferência de R$ " . number_format($valor, 2, ',', '.') . " realizada com sucesso!\n";
    return true;
    }


    $contaAna = new ContaBancaria(
        numeroConta: "1001",
        nomeTitular: "Ana Souza",
        cpfTitular: "123.456.789-00",
        nomeAgencia: "Centro",
        tipoConta: "Corrente",
        saldo: 800.00,
        ativo: true
    );

    $contaCarlos = new ContaBancaria(
        numeroConta: "1002",
        nomeTitular: "Carlos Oliveira",
        cpfTitular: "234.567.890-11",
        nomeAgencia: "Centro",
        tipoConta: "Poupança",
        saldo: 200.00,
        ativo: true
    );

    $contaMariana = new ContaBancaria(
        numeroConta: "1003",
        nomeTitular: "Mariana Lima",
        cpfTitular: "345.678.901-22",
        nomeAgencia: "Norte",
        tipoConta: "Corrente",
        saldo: 1500.00,
        ativo: true
    );

    $contaCarlos->depositar(100.00);

    $contaMariana->sacar(200.00);

    $contaAna->transferir(300.00, $contaCarlos);

    $contaAna->sacar(600.00);

    $contaMariana->bloquearConta();
    $contaMariana->depositar(500.00);

    echo "\n--- SALDOS FINAIS ---\n";
    $contaAna->consultarSaldo();      
    $contaCarlos->consultarSaldo();  
    $contaMariana->consultarSaldo(); 


    }
   
?>