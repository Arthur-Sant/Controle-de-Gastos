#Contanto: arthursantaguiar@gmail.com

Pra começar, pegue o código que está na pasta chamada BD e execute no seu banco de
dados (programa MySql usado nesse projeto) - para a conexão do php com o banco de
foi usado o método PDO. Para exclusão de usuário, conta, categoria ou lançamento,
é preciso excluir a parte que depende da parte que você deseja excluir. A ordem é:
usuário -> categoria -> conta -> lançamento.
EX: caso queira excluir alguma categoria, e preciso excluir primeiro o lançamento que
está associado a conta, e depois excluir a conta que está associado a categoria que
queira apagar. Para exclusão do usuário é preciso excluir todas as categorias.


---------------------------------- Bom Aproveito-------------------------------