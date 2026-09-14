/**
 * Venix Concierge badge / service tag.
 * @startingPoint
 */
export interface BadgeProps extends React.HTMLAttributes<HTMLSpanElement> {
  /** @default "brand" */
  tone?: 'brand' | 'outline' | 'gold' | 'solid' | 'dark' | 'muted' | 'warm' | 'inverse';
  /** Gold leading dot. @default false */
  dot?: boolean;
  children?: React.ReactNode;
}
/** @startingPoint */
export declare function Badge(props: BadgeProps): JSX.Element;
