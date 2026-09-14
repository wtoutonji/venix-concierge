/**
 * Venix Concierge button. Square-precise 6px radius, uppercase Montserrat,
 * burgundy primary. Arabic usage drops uppercasing via the RTL base rules.
 * @startingPoint
 */
export interface ButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  /** @default "primary" */
  variant?: 'primary' | 'ghost' | 'gold' | 'text' | 'ghost-inverse';
  /** @default "md" */
  size?: 'sm' | 'md' | 'lg';
  /** Render as a different element, e.g. "a". @default "button" */
  as?: 'button' | 'a';
  children?: React.ReactNode;
}
/** @startingPoint */
export declare function Button(props: ButtonProps): JSX.Element;
