import { cn } from '@/lib/utils';
import { useLaravelReactI18n } from 'laravel-react-internationalization';
import React, { useEffect, useState } from 'react';

export function ImageUploadPreview({
  source,
  className,
  ...restProps
}: {
  source: File | string | null;
  className?: string;
} & React.ImgHTMLAttributes<HTMLImageElement>) {
  const [src, setSrc] = useState<string | null>(null);
  const { t } = useLaravelReactI18n();

  useEffect(() => {
    if (source instanceof File) {
      const objectUrl = URL.createObjectURL(source);
      setSrc(objectUrl);
      return () => {
        URL.revokeObjectURL(objectUrl);
      };
    } else {
      setSrc(source);
    }
  }, [source]);

  if (!src) return null;

  return (
    <img
      src={src}
      className={cn('mt-4 h-24 rounded-md', className)}
      {...restProps}
    />
  );
}
