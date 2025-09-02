<?php 
  
 namespace connect; 
  
 class ListaFavoritosDao { 
  
     public function Create(ListaFavoritos $u) { 
  
        // podemos passar os valores no VALUES como (?,?) e depois colocar em sequência a numeração para inserir no banco de dados  
        $sql = 'INSERT INTO usuario (nome,email,senha_hash,data_criacao) VALUES (?,?,?,?)'; 
        // $stmt está pegando a classe Conexao, e o método getConn() e usando uma função prepare(), passando como parâmetro o banco de dados, que é uma maneira rápida e segura de se trabalhar 
        $stmt = Conn::getConn()->prepare($sql); 
        // $l que está vindo como uma instância, para depois podermos acessar os dados que quisermos da classe, basicamente só retornando o valor 
        $stmt->bindValue(1, $u->getNome()); 
        $stmt->bindValue(2, $u->getEmail()); 
        $stmt->bindValue(3, $u->getSenha()); 
        $stmt->bindValue(4, $u->getDataCriacao()); 
        // depois usamos o execute() para fazer a query com o banco de dados   
        if ($stmt->execute()) return true;
        else return false;
     } 
  
     // a funcão Read vai ler todos os dados do banco de dados e depois repassá-los com a lógica usada abaixo 
     public function Read() { 
  
         $sql = 'SELECT * FROM usuario'; 
         $stmt = Conn::getConn()->prepare($sql); 
         $stmt->execute(); 
  
         // RowCount é uma função do PDO, que retorna a quantidade de valores no banco de dados 
         if($stmt->rowCount() > 0): 
             // FetchAll é uma função que é retornado em forma de Array(). Isso vai ser retornado, caso haja valores no banco de dados 
             $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC); 
             return $resultado; 
         else: 
             // Caso não haja, irá retornar um array vazio 
             return []; 
         endif; 
  
  
     } 
  
     // Essa função irá atualizar uma linha específica no banco de dados 
     public function Update(ListaFavoritos $u) { 
      
         $sql = 'UPDATE usuario SET nome = ?, email = ?, senha_hash = ?, data_criacao = ? WHERE id_user = ?'; 
  
         $stmt = Conn::getConn()->prepare($sql); 
  
         // aonde vai retornar os valores e atualizá-los
        $stmt->bindValue(1, $u->getNome()); 
        $stmt->bindValue(2, $u->getEmail()); 
        $stmt->bindValue(3, $u->getSenha()); 
        $stmt->bindValue(4, $u->getDataCriacao());
        $stmt->bindValue(5, $u->getId()); 

        if ($stmt->execute()) return true;
        else return false;  
     } 
  
     // A função que irá deletar os dados específicos de uma linha no banco de dados, passando como parâmetro um $id para específicar. Podemos também passar uma instância, como em Create e Update, para chamarmos $produtoDao->Delete($produto->getId($id)); 
     public function Delete($c) { 
  
         // Vamos deletar dessa forma a linha que queremos 
         $sql = 'DELETE FROM usuario WHERE id_user = ?'; 
         $stmt = Conn::getConn()->prepare($sql); 
         $stmt->bindValue(1, $c); 
         
        if ($stmt->execute()) return true;
        else return false;
     } 
  
 }