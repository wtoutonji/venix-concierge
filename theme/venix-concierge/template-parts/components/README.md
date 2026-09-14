# Components

Create small reusable theme UI components here.

Do not build a giant widget library preemptively.

Add a component only when it has complete semantic PHP markup, an accessible
interaction model where needed, scoped assets, and a documented stable
contract. Do not keep placeholder component assets in the client theme.

Components with motion must explicitly respect `prefers-reduced-motion: reduce`. Reduce or remove only motion that may cause discomfort or is unnecessary; do not indiscriminately disable all animation across the theme.
