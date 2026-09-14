# Git Workflow

Each client project is an independent Git repository derived from this starter. Do not ship or copy the starter's `.git/` directory. Initialize Git after project scaffolding.

## Initialize

```bash
git init
git branch -M main
git add .
git commit -m "Initial project scaffold"
```

Add a remote only after creating the repository in the chosen Git provider:

```bash
git remote add origin <repository-url>
git push -u origin main
```

## Working rules

- `main` must remain deployable.
- Use focused branches such as `feature/homepage`, `feature/header`, `fix/mobile-menu`.
- Review `git status` and `git diff` before committing.
- Never commit `PROJECT-ENV.md`, secrets, private keys, `vendor/`, or `node_modules/`.
- Never force-push, use `git reset --hard`, delete branches, or rewrite shared history unless explicitly requested.
- Keep commits focused and descriptive.
- Do not auto-commit every AI change; commit at coherent milestones.

## Suggested AI completion check

```bash
git status --short
git diff --check
```
