/**
 * Venix Concierge content card — service, feature, and dark/inverse tones.
 * @startingPoint
 */
export interface CardProps extends React.HTMLAttributes<HTMLDivElement> {
  /** @default "surface" */
  tone?: 'surface' | 'warm' | 'inverse';
  /** Apply the soft wine card shadow. @default false */
  elevated?: boolean;
  /** Gold uppercase kicker above the title. */
  eyebrow?: string;
  /** Short gold hairline above the content. @default false */
  rule?: boolean;
  title?: string;
  children?: React.ReactNode;
}
/** @startingPoint */
export declare function Card(props: CardProps): JSX.Element;
