{include file="header.tpl"}
< <div class="row mt-5">
       <div class="col-4 offset-4">
         <h1>Witaj ponownie</h1>
         <p>Id użytkownika: {$id}
         </p>
         <p>Email użytkownika: {$email}
         </p>
         <form action="index.php" method="post">
         <input type="hidden" name="action" value="logout">
         <button type="submit" class="btn btn-primary w-100">Wyloguj</button>
         </form>
       </div>
    </div>
{include file="footer.tpl"}