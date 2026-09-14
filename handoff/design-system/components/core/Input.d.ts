/**
 * Venix Concierge form field — text input, select, or textarea with label and hint.
 * @startingPoint
 */
export interface InputProps extends React.InputHTMLAttributes<HTMLInputElement> {
  /** Field element to render. @default "input" */
  as?: 'input' | 'select' | 'textarea';
  /** Uppercase field label. */
  label?: string;
  /** Helper or error text below the field. */
  hint?: string;
  /** Error state — burgundy border. @default false */
  invalid?: boolean;
}
/** @startingPoint */
export declare function Input(props: InputProps): JSX.Element;
