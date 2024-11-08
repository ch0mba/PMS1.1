function deleteRow(id){
    // Generate a random authorization code

    const authCode = Math.floor(1000+Math.random() * 9000); //4-digits code

    //Display the authorization code to the user
    const enteredCode = prompt(`Authorization required. Enter the folowing authorization code to confirm deletion: ${authCode}`);

    //check if the user entered the correct code

    if (enteredCode === String(authCode)){
        if (confirm("Are you sure you want to delete this product?")) {
            // Send  a request to delete the machine form the database
        fetch('../api/product_delete.php', {
            method: 'POST',
            headers: {
                'content-Type': 'application/json'
            },
            body: JSON.stringify({id: id, authCode: enteredCode}),

        })
        .then(response => response.json())
        .then(result => {
            if (result.success){
                alert("Product deleted  successfully");
                location.reload(); //Reload to reflect changes
            } else {
                alert("Failed to delete product. " + result.error);
            }
        })
        .catch(error => console.error('Error deleting product:', error));
        }
    } else {
        alert("Incorrect authorization code. Deletion cancelled");
    }
}