window.Echo.private(`App.Models.Admin.${adminId}`)
    .notification((notification) => {
        console.log('New notification:', notification);
        // You can update UI here in real-time
    });
