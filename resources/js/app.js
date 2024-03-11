import './bootstrap';
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;
import "jquery-ui/dist/jquery-ui";

// Tooltip
const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);
