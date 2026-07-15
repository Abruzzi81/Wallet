document.addEventListener("DOMContentLoaded", function() {
    // 1. Pobieramy aktualną ścieżkę z paska adresu 
    let currentPath = window.location.pathname.replace(/^\/+/g, '').split('?')[0].toLowerCase();

    // 2. Jeśli ścieżka jest pusta (użytkownik wszedł na stronę główną "/"), traktujemy ją jako "dashboard"
    if (currentPath === "") {
        currentPath = "dashboard";
    }

    console.log("=== DEBUG SYSTEMU ROUTINGU ===");
    console.log("Twój router przetwarza teraz ścieżkę:", currentPath);

    // 3. Znajdujemy wszystkie linki w Twoim menu bocznym
    const navItems = document.querySelectorAll('.sidebar_nav_item');

    if (navItems.length === 0) {
        console.error("BŁĄD: Nie znaleziono elementów z klasą '.sidebar_nav_item' w HTML!");
        return;
    }

    navItems.forEach(item => {
        // Pobieramy wartość atrybutu href
        const hrefValue = item.getAttribute('href').toLowerCase();

        console.log(`Porównanie przycisku: href="${hrefValue}" z adresem URL="${currentPath}"`);

        // 4. Jeśli czysta ścieżka z paska adresu jest dokładnie taka sama jak href w menu
        if (currentPath === hrefValue) {
            item.classList.add('active');
            console.log(`-> SUKCES: Podświetlono element oznaczony jako: ${hrefValue}`);
        } else {
            item.classList.remove('active');
        }
    });
});