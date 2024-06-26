import "./bootstrap";
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;
import "jquery-ui/dist/jquery-ui";
import "./functions";
import "./toasts";
import "./profile";
import "./tags";
import "./ratings";
import "./aside";
import "./filter";

// Tooltip
const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);
