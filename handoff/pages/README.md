# DC Page Handoff

Place one approved self-contained Claude Design page export per page here, for
example:

- `Home.dc.html`
- `About.dc.html`
- `Services.dc.html`
- `Contact.dc.html`

Use stable human-readable filenames. Do not edit an approved DC file merely to
make production implementation easier; adapt WordPress to the approved design
while following the architecture and `docs/DC-HANDOFF.md`.

The `.dc.html` may contain design-runtime constructs such as `sc-if`, `sc-for`,
`image-slot`, inline style/state helpers or support scripts. These communicate
intent only and must be mapped to production WordPress equivalents.
