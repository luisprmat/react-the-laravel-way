import { cn } from '@/lib/utils';
import { PaginationLinks, PaginationMeta } from '@/types';
import { Link } from '@inertiajs/react';
import { useLaravelReactI18n } from 'laravel-react-internationalization';
import { ChevronLeft, ChevronRight } from 'lucide-react';
import { Button } from './ui/button';

type PaginationProps = {
  meta: PaginationMeta;
  links: PaginationLinks;
  className?: string;
};

export function Pagination({ meta, links, className }: PaginationProps) {
  const { t } = useLaravelReactI18n();

  return (
    <div className={cn('flex items-center justify-between', className)}>
      <div>
        {links.prev && (
          <Button asChild variant="ghost">
            <Link preserveScroll href={links.prev}>
              <ChevronLeft className="size-4" />
              <span>{t('Previous')}</span>
            </Link>
          </Button>
        )}
      </div>
      <p className="text-sm font-medium">
        {t('page')} {meta.current_page} {t('of')} {meta.last_page}
      </p>
      <div>
        {links.next && (
          <Button asChild variant="ghost">
            <Link preserveScroll href={links.next}>
              <span>{t('Next')}</span>
              <ChevronRight className="size-4" />
            </Link>
          </Button>
        )}
      </div>
    </div>
  );
}
